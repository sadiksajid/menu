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
        Schema::create('staf_product_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title', 150);
            $table->string('category_meta', 50)->unique();
            $table->string('s_title', 500);
            $table->string('image', 150)->nullable();
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
        Schema::dropIfExists('staf_product_categories');
    }
};
