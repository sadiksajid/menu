<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreToClientNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_to_client_notifications', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('store_id');
            $table->foreignId('client_id');
            $table->string('title',100);
            $table->string('desctiption',500);
            $table->string('image',150)->nullable();
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
        Schema::dropIfExists('store_to_client_notifications');
    }
}
