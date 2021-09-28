<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigIncrements('people_origin');
            $table->bigIncrements('people_destiny');
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('location_origin');
            $table->bigInteger('location_destiny');
            $table->string('status');
            $table->bigInteger('user');
            $table->bigInteger('request_from')->nullable();
            $table->decimal('amount', 11,4)-nullable();
            $table->decimal('discount', 11,4)->nullable();
            $table->string('status')->nullable();
            $table->foreign('people_origin')->references('id')->on('people');
            $table->foreign('location_origin')->references('id')->on('locations');
            $table->foreign('user')->references('id')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
