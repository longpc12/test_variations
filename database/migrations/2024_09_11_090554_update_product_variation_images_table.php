<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductVariationImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variation_images', function (Blueprint $table) {
            // Xóa khóa ngoại cũ
            $table->dropForeign(['product_id']);
            $table->dropForeign(['attribute_value_id']);
            $table->dropColumn('product_id');
            $table->dropColumn('attribute_value_id');

            // Thêm khóa ngoại mới
            $table->unsignedBigInteger('product_variation_id');
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variation_images', function (Blueprint $table) {
            // Hoàn tác thay đổi: xóa khóa ngoại mới và khôi phục khóa ngoại cũ
            $table->dropForeign(['product_variation_id']);
            $table->dropColumn('product_variation_id');

            // Khôi phục khóa ngoại cũ
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('attribute_value_id');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
        });
    }
}
