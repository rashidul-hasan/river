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
        Schema::create('river_data_fields', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_type_id');
            $table->string('label');
            $table->string('slug');
            $table->string('type')->default(\Rashidul\River\Constants::FIELD_TYPE_TEXT);
            $table->boolean('is_required')->default(0);
            $table->boolean('is_nullable')->default(1);
            $table->boolean('show_on_list')->default(1);
            $table->string('validation_rules')->nullable();
            $table->integer('order')->default(1);
            $table->string('default')->nullable();
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
        Schema::dropIfExists('river_data_fields');
    }
};
