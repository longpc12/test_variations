<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_groups', function (Blueprint $table) {
            // Xóa khóa ngoại và cột attribute_value_id
            if (Schema::hasColumn('attribute_groups', 'attribute_value_id')) {
                $table->dropForeign('attribute_group_values_attribute_value_id_foreign');
                $table->dropColumn('attribute_value_id');
            }

            // Thêm cột attribute_id nếu chưa tồn tại
            if (!Schema::hasColumn('attribute_groups', 'attribute_id')) {
                $table->unsignedBigInteger('attribute_id')->after('group_id');
                $table->foreign('attribute_id')->references('id')->on('attributes');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_groups', function (Blueprint $table) {
            // Xóa khóa ngoại attribute_id nếu tồn tại
            if (Schema::hasColumn('attribute_groups', 'attribute_id')) {
                $table->dropForeign(['attribute_id']);
                $table->dropColumn('attribute_id');
            }

            // Khôi phục cột attribute_value_id và khóa ngoại
            $table->unsignedBigInteger('attribute_value_id')->after('group_id');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values');
        });
    }
}
