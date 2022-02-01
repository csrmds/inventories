<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDcServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dc_servers', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->nullable();
            $table->string('host');
            $table->string('domain_name');
            $table->string('user');
            $table->string('password')->nullable();
            $table->integer('port')->default('389');
            $table->string('status')->nullable()->default('ATIVADO');
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
        Schema::dropIfExists('dc_servers');
    }
}
