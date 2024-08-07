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
        Schema::create('shipping_company_to_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_company_id');
            $table->foreignId('store_id');
            $table->integer('api_id')->nullable()->unique();
            $table->enum('status', ['pending', 'active', 'inactive','refused','disabled'])->default('pending');
            $table->string('reason',1500)->nullable();

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
        Schema::dropIfExists('shipping_company_to_stores');
    }
};
