<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationGroupImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_group_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_variation_group_id');
            $table->unsignedBigInteger('variation_image_id'); // Thêm khóa ngoại này
            $table->timestamps();

            // Khóa ngoại cho product_variation_group_id
            $table->foreign('product_variation_group_id', 'pv_group_img_foreign')
                  ->references('id')->on('product_variation_groups')
                  ->onDelete('cascade');

            // Khóa ngoại cho variation_image_id
            $table->foreign('variation_image_id', 'variation_image_foreign')
                  ->references('id')->on('variation_images')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation_group_images');
    }
}
