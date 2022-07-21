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
        Schema::create('river_field_values', function (Blueprint $table) {
            $table->bigInteger('data_type_id');
            $table->bigInteger('data_entry_id');
            $table->bigInteger('data_field_id');
            $table->string('data_field_slug');
            $table->text('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('river_field_values');
    }
};
