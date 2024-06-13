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
        Schema::create('compition_clients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 50);
            $table->string('phone', 50);
            $table->integer('total_pull')->default(0);
            $table->timestamp('date_scan')->nullable();
            $table->boolean('is_winner')->default(0);
            $table->boolean('black_list')->default(0);
            $table->string('image', 350)->nullable();;

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
        Schema::dropIfExists('compition_clients');
    }
};
