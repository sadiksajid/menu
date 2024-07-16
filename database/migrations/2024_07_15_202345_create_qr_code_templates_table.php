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
        Schema::create('qr_code_templates', function (Blueprint $table) {
            $table->id();
            $table->string('image',255);
            $table->string('preview',255);
            $table->string('logo_config',250)->nullable();
            $table->string('qr_config',250)->nullable();
            $table->string('text_config',250)->nullable();
            $table->string('image_config',250)->nullable();
            $table->integer('downloads')->default(0);
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
        Schema::dropIfExists('qr_code_templates');
    }
};
