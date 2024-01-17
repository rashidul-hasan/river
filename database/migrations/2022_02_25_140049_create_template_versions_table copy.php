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
        Schema::create('river_template_pages_versions', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->longText('code')->nullable();
            $table->dateTime('datetime')->default()->useCurrent();
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
