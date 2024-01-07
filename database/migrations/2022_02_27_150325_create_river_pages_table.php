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
            $table->text('header_code')->nullable();
            $table->text('footer_code')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_published')->nullable();
            $table->longText('content')->nullable();
            $table->integer('content_type')->default(\Rashidul\River\Models\RiverPage::CONTENT_TYPE_HTML);
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
