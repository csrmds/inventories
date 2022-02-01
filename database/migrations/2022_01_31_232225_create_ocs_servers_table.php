<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcsServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocs_servers', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->nullable();
            $table->string('host');
            $table->string('database_name')->default('ocsweb');
            $table->string('database_user')->default('ocs');
            $table->string('database_password')->default('ocs');
            $table->integer('database_port')->default('3306');
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
        Schema::dropIfExists('ocs_servers');
    }
}
