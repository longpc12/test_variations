<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['variations.attributeValue', 'variations.group', 'variations.variationValues', 'variations.variationImages'])->get();

        return  ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tìm sản phẩm theo id và bao gồm các quan hệ cần thiết
        $product = Product::with(['variations.attributeValue', 'variations.group', 'variations.variationValues', 'variations.variationImages'])
            ->findOrFail($id); // Nếu không tìm thấy, trả về 404

        // Trả về kết quả dưới dạng ProductResource
        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
