<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_url')->nullable();
            $table->string('image')->nullable();
            $table->string('group')->nullable();
            $table->boolean('status')->nullable();
            $table->string('open_new_tab')->nullable();
            $table->integer('orders')->nullable();

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
        Schema::dropIfExists('river_sliders');
    }
}
