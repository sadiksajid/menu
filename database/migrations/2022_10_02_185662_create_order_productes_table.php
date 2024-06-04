<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_productes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_product_id');
            $table->foreignId('store_order_id');
            $table->integer('qte')->default(1);
            $table->integer('price')->nullable();
            $table->integer('total')->nullable();
            $table->string('comment')->nullable();
            $table->integer('offer_id')->nullable();
            $table->integer('is_offer')->default(0);

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
        Schema::dropIfExists('order_productes');
    }
}
