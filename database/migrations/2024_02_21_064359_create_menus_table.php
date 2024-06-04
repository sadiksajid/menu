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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->string('name', 20);
            $table->string('language', 20);
            $table->text('titles', 3000)->nullable();;
            $table->text('texts', 10000)->nullable();;
            $table->text('buttons', 3000)->nullable();;
            $table->text('images', 3000)->nullable();
            $table->text('urls', 3000)->nullable();
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
        Schema::dropIfExists('menus');
    }
};
