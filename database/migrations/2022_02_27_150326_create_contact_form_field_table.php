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
        Schema::create('river_contact_form_field', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contactformfield_id');
            $table->string('slug');
            $table->string('singular')->nullable();
            $table->string('plural')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('show_on_menu')->default(0);
            $table->timestamps();


            $table->foreign('contactformfield_id')->references('id')->on('river_contact_form')->onDelete('cascade');
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
