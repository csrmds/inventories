<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('sn')->nullable();
            $table->string('tag')->nullable();
            $table->string('property_id')->nullable();
            $table->bigInteger('size_id')->nullable();
            $table->bigInteger('color_id')->nullable();
            $table->string('um')->nullable();
            $table->string('status')->nullable();
            $table->string('obs')->nullable();
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
        Schema::dropIfExists('products');
    }
}
