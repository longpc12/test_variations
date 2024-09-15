<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeyAndColumnFromVariationImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variation_images', function (Blueprint $table) {
            // Xóa khóa ngoại trước khi xóa cột
            $table->dropForeign(['product_variation_id']); // Xóa khóa ngoại
            $table->dropColumn('product_variation_id'); // Xóa luôn cột
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variation_images', function (Blueprint $table) {
            // Thêm lại cột
            $table->unsignedBigInteger('product_variation_id');
            
            // Thêm lại khóa ngoại nếu cần khôi phục
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade');
        });
    }
}
