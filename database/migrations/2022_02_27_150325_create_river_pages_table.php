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
        Schema::create('river_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('menu_title')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_published')->nullable();
            $table->longText('content')->nullable();
            $table->string('content_type')->nullable();
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
        Schema::dropIfExists('river_pages');
    }
};
