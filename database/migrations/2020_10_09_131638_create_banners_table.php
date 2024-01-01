<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->string('Subtitle')->nullable();
            $table->string('button_one_text')->nullable();
            $table->string('button_one_url')->nullable();
            $table->string('button_two_url')->nullable();
            $table->string('button_two_text')->nullable();
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
        Schema::dropIfExists('river_banners');
    }
}
