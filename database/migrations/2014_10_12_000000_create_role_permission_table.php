<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_role_permission', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->integer('type')->default(\BitPixel\SpringCms\Models\RolePermission::TYPE_ROUTE);
            $table->string('permission');
            // permission cooumn will hold a route name, means the role_id
            //has access to that route name, single row for each role id &
            // permission combination
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('river_role_permission');
    }
};
