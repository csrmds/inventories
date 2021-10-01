<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
            $table->string('description')->nullable();
            $table->integer('order', 11,4);
            $table->decimal('amount', 11,4);
            $table->decimal('value', 11,4)->nullable();
            $table->decimal('discount', 11,4)->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
            // $table->foreign('order_id')->references('id')->on('orders');
            // $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
