<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributes', function (Blueprint $table) {
            // Xóa khóa ngoại nếu có
            $table->dropForeign(['attribute_type_id']);

            // Xóa cột attribute_type_id
            $table->dropColumn('attribute_type_id');

            // Thêm cột attribute_type
            $table->tinyInteger('attribute_type')->unsigned()->after('name')->comment('1: primary, 2: secondary');
        });

        // Xóa bảng attribute_types nếu không cần dùng
        Schema::dropIfExists('attribute_types');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes', function (Blueprint $table) {
            // Khôi phục lại cột attribute_type_id
            $table->unsignedBigInteger('attribute_type_id')->nullable();

            // Tạo lại khóa ngoại
            $table->foreign('attribute_type_id')->references('id')->on('attribute_types')->onDelete('cascade');

            // Xóa cột attribute_type
            $table->dropColumn('attribute_type');
        });

        // Tạo lại bảng attribute_types
        Schema::create('attribute_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
}
