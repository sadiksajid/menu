<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_stores', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['active', 'warning', 'block'])->default('active');
            $table->boolean('trusted')->default(0);
            $table->foreignId('client_id');
            $table->foreignId('store_id');
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
        Schema::dropIfExists('client_stores');
    }
}
