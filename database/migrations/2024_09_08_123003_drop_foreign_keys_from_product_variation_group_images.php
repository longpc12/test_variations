<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeysFromProductVariationGroupImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Xóa các khóa ngoại từ bảng `product_variation_group_images`
        Schema::table('product_variation_group_images', function (Blueprint $table) {
            $table->dropForeign('pv_group_img_foreign');  // Xóa khóa ngoại với `product_variation_groups`
            $table->dropForeign('variation_image_foreign');  // Xóa khóa ngoại với `variation_images`
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Phục hồi lại các khóa ngoại nếu cần rollback
        Schema::table('product_variation_group_images', function (Blueprint $table) {
            $table->foreign('product_variation_group_id')->references('id')->on('product_variation_groups')->onDelete('cascade');
            $table->foreign('variation_image_id')->references('id')->on('variation_images')->onDelete('cascade');
        });
    }
}
