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
        Schema::create('staf_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('staf_product_category_id');
            $table->string('title', 250);
            $table->string('product_meta', 250)->unique();
            $table->string('description', 3500);
            $table->double('price')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('staf_products');
    }
};
