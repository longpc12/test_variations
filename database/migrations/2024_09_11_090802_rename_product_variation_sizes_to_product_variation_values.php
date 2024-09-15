<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameProductVariationSizesToProductVariationValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Đổi tên bảng product_variation_sizes thành product_variation_values
        Schema::rename('product_variation_sizes', 'product_variation_values');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Đổi lại tên bảng nếu cần rollback
        Schema::rename('product_variation_values', 'product_variation_sizes');
    }
}
