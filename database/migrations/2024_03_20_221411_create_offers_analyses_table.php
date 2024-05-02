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
        Schema::create('offers_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->foreignId('offer_id');
            $table->integer('views')->default(0);
            $table->integer('orders')->default(0);
            $table->integer('total')->default(0);

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
        Schema::dropIfExists('offers_analyses');
    }
};
