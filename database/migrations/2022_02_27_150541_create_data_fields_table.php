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
        Schema::create('data_fields', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_type_id');
            $table->string('label');
            $table->string('slug');
            $table->boolean('is_required')->default(0);
            $table->boolean('show_on_list')->default(1);
            $table->string('validation_rules')->nullable();
            $table->integer('order')->default(1);
            $table->integer('type')->default(1);
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
        Schema::dropIfExists('data_fields');
    }
};
