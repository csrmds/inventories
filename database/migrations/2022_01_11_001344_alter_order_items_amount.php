<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderItemsAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('amount', 11, 4)->default(0)->nullable()->change();
            $table->decimal('value', 11, 4)->default(0)->change();
            $table->decimal('discount', 11, 4)->default(0)->change();
            $table->integer('order')->unsigned()->change();
            $table->dropPrimary('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
}
