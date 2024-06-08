<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->string('password');
            $table->string('remember_token',200)->nullable();

            $table->boolean('status')->default(1);
            $table->string('phone_code',5)->nullable();
            $table->foreignId('country_id');
            $table->string('country',50)->nullable();
            
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
        Schema::dropIfExists('store_admins');
    }
}
