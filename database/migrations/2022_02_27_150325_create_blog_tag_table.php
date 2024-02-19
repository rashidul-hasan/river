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
        Schema::create('river_blog_tag', function (Blueprint $table) {
            $table->id();

            // $table->foreign('blog_id')->constraiend();
            // $table->foreign('tag_id')->constraiend();
            $table->unsignedBigInteger('blog_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
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
        Schema::dropIfExists('river_blog_tag');
    }
};
