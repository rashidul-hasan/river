<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use BitPixel\SpringCms\Models\TemplatePage;
use BitPixel\SpringCms\Models\TemplateAssets;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_template_assets', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->longText('code')->nullable();
            $table->integer('type')->default(TemplatePage::TYPE_SIMPLE);
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
        Schema::dropIfExists('river_template_pages');
    }
};
