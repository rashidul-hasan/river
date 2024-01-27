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
        Schema::create('river_contactform_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contactform_id');
            $table->string('name');
            $table->string('slug');
            $table->string('type')->nullable();
            $table->boolean('is_required')->nullable()->default(0);
            
            $table->timestamps();


            $table->foreign('contactform_id')->references('id')->on('river_contact_form')->onDelete('cascade');
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
