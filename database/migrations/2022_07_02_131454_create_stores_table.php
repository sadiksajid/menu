<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_meta', 20)->unique();
            $table->string('title', 300)->nullable();
            $table->string('s_title', 600)->nullable();
            $table->string('description', 2600)->nullable();
            $table->string('phone', 150);
            $table->string('phone2', 150)->nullable();
            $table->string('email', 150);
            $table->string('facebook', 250)->nullable();
            $table->string('instagram', 250)->nullable();
            $table->string('tiktok', 250)->nullable();
            $table->string('logo', 150)->nullable();
            $table->string('address', 250)->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('city',100)->nullable();
            $table->foreignId('quartier_id')->nullable();
            $table->string('longitude', 20)->nullable();
            $table->string('latitude', 20)->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('shipping')->default(0);
            $table->boolean('preorder')->default(0);
            $table->string('currency', 10)->nullable();
            $table->string('btn_color', 20)->nullable();
            $table->string('text_color', 20)->nullable();
            $table->string('background_color', 20)->nullable();
            $table->boolean('first_run')->default(1);
            $table->string('first_run_steps',300)->nullable();

            $table->integer('country_id',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('country_code',50)->nullable();
            $table->enum('print_type', ['auto', 'manual'])->default('manual');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
