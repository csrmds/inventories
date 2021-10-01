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
            $table->foreignId('people_origin')->constrained('people');
            $table->bigInteger('people_destiny');
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('location_origin')->constrained('locations');
            $table->bigInteger('location_destiny');
            $table->foreignId('user_id')->constrained('users');
            $table->bigInteger('request_from')->nullable();
            $table->decimal('value', 11,4)->nullable();
            $table->decimal('discount', 11,4)->nullable();
            $table->string('status')->nullable();
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
