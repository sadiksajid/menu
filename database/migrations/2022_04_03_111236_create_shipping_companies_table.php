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
        Schema::create('shipping_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('tag',250);
            $table->string('site',250)->nullable();
            $table->string('logo',250)->nullable();
            $table->json('contact_info',1500)->nullable();
            $table->string('token',500)->nullable();
            $table->string('username',250)->nullable();
            $table->string('password',250)->nullable();
            $table->json('working_time',2500)->nullable();
            $table->json('pricing',2500)->nullable();
            $table->string('country',150)->nullable();
            $table->json('cities',2500)->nullable();
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
        Schema::dropIfExists('shipping_companies');
    }
};
