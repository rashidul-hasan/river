<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rashidul\River\Models\TemplatePage;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_pages', function (Blueprint $table) {
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
        Schema::dropIfExists('template_pages');
    }
};
