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
        Schema::create('store_staf_passwords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->string('fullname', 50);
            $table->string('role', 20);
            $table->string('password', 1000);
            $table->string('code', 50);
            $table->string('code_bar',500);
            $table->boolean('status')->default(1);
            $table->timestamp('last_use')->nullable();

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
        Schema::dropIfExists('store_staf_passwords');
    }
};
