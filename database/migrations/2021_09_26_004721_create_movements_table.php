<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigIncrements('product_id');
            $table->bigIncrements('order_id');
            $table->bigIncrements('order_item_id');
            $table->decimal('amount',11,4);
            $table->string('movement');
            $table->bigIncrements('order_reference_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movements', function (Blueprint $table) {
            //
        });
    }
}
