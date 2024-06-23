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
            $table->string('title', 300);
            $table->string('s_title', 600);
            $table->string('description', 2600);
            $table->string('phone', 150);
            $table->string('phone2', 150);
            $table->string('email', 150);
            $table->string('facebook', 250);
            $table->string('instagram', 250);
            $table->string('tiktok', 250);
            $table->string('logo', 150);
            $table->string('address', 250);
            $table->foreignId('city_id');
            $table->foreignId('quartier_id');
            $table->string('longitude', 20);
            $table->string('latitude', 20);
            $table->boolean('status')->default(1);
            $table->boolean('shipping')->default(0);
            $table->boolean('preorder')->default(0);
            $table->string('currency', 10)->nullable();
            $table->string('btn_color', 20)->nullable();
            $table->string('text_color', 20)->nullable();
            $table->string('background_color', 20)->nullable();
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
