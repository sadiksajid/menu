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
            $table->string('preview',255)->nullable();
            
            $table->json('image')->nullable();
            $table->json('qr_config')->nullable();
            $table->json('logo_config')->nullable();
            $table->json('phone1_config')->nullable();
            $table->json('phone2_config')->nullable();
            $table->json('email_config')->nullable();
            $table->json('title_config')->nullable();


            $table->integer('downloads')->default(0);
            $table->boolean('status')->default(1);
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
