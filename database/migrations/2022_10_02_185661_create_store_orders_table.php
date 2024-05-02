<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->foreignId('client_id')->nullable();
            $table->foreignId('client_address_id')->nullable();;
            $table->string('comment')->nullable();;
            $table->string('currency')->nullable();
            $table->integer('total')->nullable();
            $table->enum('status', ['pending', 'declined', 'confirmed', 'shipped', 'delivered', 'ready', 'canceled', 'dispute', 'return', 'caisse_pending', 'caisse_delivered', 'caisse_canceled'])->default('pending');
            $table->integer('shipping_cost')->default(0);
            $table->boolean('from_web')->default(0);
            $table->enum('order_type', ['shipping', 'coming', 'caisse'])->default('shipping');
            $table->string('payment_type', 10)->nullable();
            $table->string('tracking', 15)->nullable();
            $table->text('admin_comment', 1500)->nullable();
            $table->integer('receiver_calls')->default(0);
            $table->timestamp('coming_date')->nullable();
            $table->text('offers', 1500)->nullable();
            $table->foreign('admin_id')->references('id')->on('users');

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
        Schema::dropIfExists('store_orders');
    }
}
