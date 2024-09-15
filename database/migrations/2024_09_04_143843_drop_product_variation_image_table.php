<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropProductVariationImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hủy các khóa ngoại trước khi xóa bảng
        Schema::table('product_variation_image', function (Blueprint $table) {
            // Hủy khóa ngoại của cột product_variation_id
            $table->dropForeign(['product_variation_id']);
            
            // Hủy khóa ngoại của cột variation_image_id
            $table->dropForeign(['variation_image_id']);
        });

        // Xóa bảng product_variation_image
        Schema::dropIfExists('product_variation_image');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Có thể định nghĩa lại bảng nếu cần trong tương lai
        Schema::create('product_variation_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_variation_id');
            $table->unsignedBigInteger('variation_image_id');
            $table->timestamps();

            // Thêm khóa ngoại lại (trong trường hợp rollback)
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade');
            $table->foreign('variation_image_id')->references('id')->on('variation_images')->onDelete('cascade');
        });
    }
}
