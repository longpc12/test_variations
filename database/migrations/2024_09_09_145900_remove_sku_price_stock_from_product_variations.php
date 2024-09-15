<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSkuPriceStockFromProductVariations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variations', function (Blueprint $table) {
            // Xóa các cột không cần thiết
            $table->dropColumn(['sku', 'price', 'stock']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variations', function (Blueprint $table) {
            // Thêm lại các cột khi rollback
            $table->string('sku', 255)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('stock')->nullable();
        });
    }
}
