<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameVariationImagesAndAddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Đổi tên bảng `variation_images` thành `product_variation_images`
        Schema::rename('variation_images', 'product_variation_images');

        // Thêm khóa ngoại `product_id` và `attribute_value_id`
        Schema::table('product_variation_images', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');  // Thêm cột product_id
            $table->unsignedBigInteger('attribute_value_id');  // Thêm cột attribute_value_id

            // Tạo khóa ngoại
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Gỡ bỏ khóa ngoại và cột
        Schema::table('product_variation_images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['attribute_value_id']);
            $table->dropColumn(['product_id', 'attribute_value_id']);
        });

        // Đổi tên bảng lại thành `variation_images`
        Schema::rename('product_variation_images', 'variation_images');
    }
}
