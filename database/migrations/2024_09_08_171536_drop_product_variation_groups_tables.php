<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropProductVariationGroupsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Xóa bảng `product_variation_group_images`
        Schema::dropIfExists('product_variation_group_images');

        // Xóa bảng `product_variation_groups`
        Schema::dropIfExists('product_variation_groups');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Phục hồi lại bảng `product_variation_groups`
        Schema::create('product_variation_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('group_name', 255);
            $table->timestamps();
        });

        // Phục hồi lại bảng `product_variation_group_images`
        Schema::create('product_variation_group_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variation_group_id')->constrained()->onDelete('cascade');
            $table->foreignId('variation_image_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
}
