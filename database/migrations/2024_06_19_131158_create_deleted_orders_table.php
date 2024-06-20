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
        Schema::create('deleted_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->foreignId('client_id')->nullable();
            $table->foreignId('client_address_id')->nullable();;
            $table->string('comment')->nullable();;
            $table->string('currency')->nullable();
            $table->integer('total')->nullable();
            $table->string('status')->nullable();
            $table->integer('shipping_cost')->default(0);
            $table->boolean('from_web')->default(0);
            $table->string('order_type')->nullable();
            $table->string('payment_type', 10)->nullable();
            $table->string('tracking', 15)->nullable();
            $table->text('admin_comment', 1500)->nullable();
            $table->integer('receiver_calls')->default(0);
            $table->timestamp('coming_date')->nullable();
            $table->text('offers', 1500)->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('users');
            $table->string('deleted_by');
            $table->integer('deleted_by_id');
            $table->string('order_products',10000);

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
        Schema::dropIfExists('deleted_orders');
    }
};
