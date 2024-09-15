<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_variation_id'); // Khóa ngoại đến bảng product_variations
            $table->unsignedBigInteger('variation_image_id'); // Khóa ngoại đến bảng variation_images
            $table->timestamps();

            // Tạo khóa ngoại
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade');
            $table->foreign('variation_image_id')->references('id')->on('variation_images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation_image');
    }
}
