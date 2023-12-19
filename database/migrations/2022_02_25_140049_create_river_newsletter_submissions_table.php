<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rashidul\River\Models\TemplatePage;
use Rashidul\River\Models\TemplateAssets;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_newsletter_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->date('date')->default(date('Y-m-d'));
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
