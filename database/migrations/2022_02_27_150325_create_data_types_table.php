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
        Schema::create('river_data_types', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('singular')->nullable();
            $table->string('plural')->nullable();
            $table->string('show_page')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('show_on_menu')->default(0);
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
        Schema::dropIfExists('river_data_types');
    }
};
