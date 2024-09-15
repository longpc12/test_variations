<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeTypeIdToAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributes', function (Blueprint $table) {
            // Thêm cột attribute_type_id và gắn khóa ngoại
            $table->unsignedBigInteger('attribute_type_id')->nullable()->after('name'); // Bổ sung trường attribute_type_id sau cột name

            // Tạo khóa ngoại liên kết với bảng attribute_types
            $table->foreign('attribute_type_id')->references('id')->on('attribute_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes', function (Blueprint $table) {
            // Xóa khóa ngoại và cột attribute_type_id khi rollback
            $table->dropForeign(['attribute_type_id']);
            $table->dropColumn('attribute_type_id');
        });
    }
}
