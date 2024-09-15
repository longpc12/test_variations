<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use App\Models\Group;
use App\Models\ProductVariation;
use App\Models\ProductVariationImage;
use App\Models\ProductVariationSize;
use App\Models\ProductVariationValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        // Lấy sản phẩm kèm theo các biến thể, nhóm, và variation values
        $products = Product::with(['variations.attributeValue', 'variations.group', 'variations.variationValues', 'variations.variationImages'])->get();
        // dd($products);
        return view('products.index', compact('products'));
    }
    
    
    
// ProductController.php
// Trong ProductController
public function create()
{
    // Lấy các nhóm thuộc tính (group) kèm theo các giá trị (attribute values) cần thiết
    $attributeGroups = Group::with(['attributeGroups.attribute.values'])->get();
    // dd($attributeGroups);
    return view('products.create', compact('attributeGroups'));
}




public function store(Request $request)
{
    // dd(($request->all()));
    // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
    DB::beginTransaction();
    
    try {
        // Tạo slug từ tên sản phẩm
        $slug = $this->generateSeoFriendlySlug($request->name);

        // Tạo sản phẩm mới
        $product = Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'price' => $request->price, // Giá gốc của sản phẩm
        ]);

        Log::info('Product created successfully', ['product_id' => $product->id]);

        // Lưu các biến thể (ví dụ như màu sắc)
        foreach ($request->variations as $attributeValueId => $sizes) {
            // Tạo biến thể chính (ví dụ như màu sắc)
            $productVariation = ProductVariation::create([
                'product_id' => $product->id,
                'group_id' => $request->group_id,
                'attribute_value_id' => $attributeValueId,
            ]);

            Log::info('Product variation created successfully', ['product_variation_id' => $productVariation->id]);

            // Lưu ảnh đại diện và album cho từng biến thể
            if ($request->hasFile("thumbnail_image_$attributeValueId")) {
                $thumbnailPath = $request->file("thumbnail_image_$attributeValueId")
                                        ->store("uploads/avata/{$product->id}/{$productVariation->id}", 'public');

                ProductVariationImage::create([
                    'product_variation_id' => $productVariation->id,
                    'image_path' => $thumbnailPath,
                    'image_type' => 'thumbnail',
                ]);

                Log::info('Thumbnail image saved', ['product_id' => $product->id, 'attribute_value_id' => $attributeValueId, 'image_path' => $thumbnailPath]);
            }

            if ($request->hasFile("album_images_$attributeValueId")) {
                foreach ($request->file("album_images_$attributeValueId") as $albumImage) {
                    $albumPath = $albumImage->store("uploads/album/{$product->id}/{$productVariation->id}", 'public');

                    ProductVariationImage::create([
                        'product_variation_id' => $productVariation->id,
                        'image_path' => $albumPath,
                        'image_type' => 'album',
                    ]);

                    Log::info('Album image saved', ['product_id' => $product->id, 'attribute_value_id' => $attributeValueId, 'image_path' => $albumPath]);
                }
            }

            // Lưu các size (kích thước) của từng biến thể
            foreach ($sizes as $sizeId => $details) {
                Log::info('Processing size', [
                    'sizeId' => $sizeId,
                    'details' => $details
                ]);

                if (!empty($details['stock']) && isset($details['discount'])) {
                    $sku = $this->generateVariationSku();
                    $calculatedPrice = $product->price - ($product->price * ($details['discount'] / 100));

                    ProductVariationValue::create([
                        'product_variation_id' => $productVariation->id,
                        'attribute_value_id' => $sizeId, // ID của kích thước (size)
                        'sku' => $sku,
                        'stock' => $details['stock'],
                        'price' => $calculatedPrice,
                        'discount' => $details['discount'] ?? null,
                    ]);

                    Log::info('Size saved', [
                        'product_variation_id' => $productVariation->id,
                        'sizeId' => $sizeId,
                        'sku' => $sku,
                        'stock' => $details['stock'],
                        'calculated_price' => $calculatedPrice,
                        'discount' => $details['discount']
                    ]);
                } else {
                    Log::warning('Size skipped due to missing stock or discount', [
                        'sizeId' => $sizeId,
                        'details' => $details
                    ]);
                }
            }
        }

        // Commit transaction nếu mọi thứ thành công
        DB::commit();

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Failed to add product', ['error' => $e->getMessage()]);
        return redirect()->back()->withErrors('Failed to add product: ' . $e->getMessage());
    }
}




    // Hàm tạo slug chuẩn SEO cho sản phẩm
    private function generateSeoFriendlySlug($productName)
    {
        $slug = Str::slug($productName);
        $randomString = Str::random(8);
        $slug = "{$slug}-{$randomString}";

        $originalSlug = $slug;
        $count = 2;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    // Hàm tạo SKU ngẫu nhiên cho biến thể
 // Hàm tạo SKU ngẫu nhiên cho biến thể (size)
private function generateVariationSku()
{
    $randomNumbers = str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
    $randomString = Str::upper(Str::random(8));
    $variationSku = "{$randomNumbers}_{$randomString}";

    $originalSku = $variationSku;
    $count = 2;

    // Kiểm tra trong bảng product_variation_sizes thay vì product_variations
    while (ProductVariationValue::where('sku', $variationSku)->exists()) {
        $variationSku = "{$originalSku}-{$count}";
        $count++;
    }

    return $variationSku;
}

}
