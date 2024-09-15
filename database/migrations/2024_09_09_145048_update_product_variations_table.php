<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variations', function (Blueprint $table) {
            // Kiểm tra nếu cột chưa tồn tại thì mới thêm
            if (!Schema::hasColumn('product_variations', 'attribute_value_id')) {
                $table->unsignedBigInteger('attribute_value_id')->after('attribute_group_id');
            }

            // Thêm khóa ngoại cho attribute_value_id, liên kết với bảng attribute_values
            $table->foreign('attribute_value_id')
                ->references('id')
                ->on('attribute_values')
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
        Schema::table('product_variations', function (Blueprint $table) {
            // Xóa khóa ngoại và cột attribute_value_id nếu rollback
            $table->dropForeign(['attribute_value_id']);
            $table->dropColumn('attribute_value_id');
        });
    }
}
