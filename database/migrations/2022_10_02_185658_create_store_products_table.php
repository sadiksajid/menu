<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreProductsTable extends Migration
{

    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->foreignId('product_category_id');
            $table->string('title', 1500);
            $table->string('product_meta', 250);
            $table->string('description', 10000);
            $table->double('price')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('to_menu')->default(0);
            $table->boolean('in_stock')->default(1);

            $table->foreignId('staf_product_id');

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
        Schema::dropIfExists('store_products');
    }
}
