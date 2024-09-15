<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameProductVariationValuesToProductVariationSizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Đổi tên bảng từ product_variation_values thành product_variation_sizes
        Schema::rename('product_variation_values', 'product_variation_sizes');

        // Thêm các cột sku, stock, price, discount
        Schema::table('product_variation_sizes', function (Blueprint $table) {
            $table->string('sku', 255)->after('attribute_value_id')->nullable();
            $table->integer('stock')->after('sku')->default(0);
            $table->decimal('price', 10, 2)->after('stock')->nullable();
            $table->integer('discount')->after('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Xóa các cột đã thêm khi rollback
        Schema::table('product_variation_sizes', function (Blueprint $table) {
            $table->dropColumn(['sku', 'stock', 'price', 'discount']);
        });

        // Đổi tên bảng lại thành product_variation_values
        Schema::rename('product_variation_sizes', 'product_variation_values');
    }
}
