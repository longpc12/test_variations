<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAttributeGroupIdToGroupIdInAttributeGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_groups', function (Blueprint $table) {
            // Đổi tên cột attribute_group_id thành group_id
            $table->renameColumn('attribute_group_id', 'group_id');
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
            // Đổi lại tên cột group_id về attribute_group_id nếu cần hoàn tác
            $table->renameColumn('group_id', 'attribute_group_id');
        });
    }
}
