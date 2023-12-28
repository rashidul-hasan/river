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
        Schema::create('river_menu_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('title');
            $table->string('url')->nullable();
            $table->integer('sort_order')->default(1);
            $table ->string('css_class')->nullable();
            $table->string('css_id')->nullable();
            $table->string('slug')->nullable();
            $table->foreign('menu_id')->references('id')->on('river_menu')->onDelete('cascade');
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
        Schema::dropIfExists('river_contact_form');
    }
};
