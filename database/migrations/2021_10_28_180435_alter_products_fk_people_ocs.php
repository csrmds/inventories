<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductsFkPeopleOcs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('products', function (Blueprint $table) {
            $table->integer('ocs_hw_id')->nullable();
            $table->integer('ocs_mon_id')->nullable();
            //$table->bigInteger('people_id')->nullable();
            

            //$table->foreign('ocs_hw_id')->references('id')->on('ocs_hardware');
            //$table->foreign('ocs_mon_id')->references('id')->on('ocs_monitors');
            //$table->foreignId('user_id')->constrained('users');
            $table->foreignId('people_id')->nullable()->constrained('people');

            
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('ocs_hw_id');
            $table->dropForeign('ocs_mon_id');
            $table->dropForeign('people_id');
        });
        Schema::enableForeignKeyConstraints();
    }
}
