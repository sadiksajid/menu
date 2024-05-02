<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appinos', function (Blueprint $table) {
            $table->id();
            $table->text('about',10000)->nullable();
            $table->text('facts',10000)->nullable();
            $table->text('products',10000)->nullable();

            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('small_logo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('appinos');
    }
}
