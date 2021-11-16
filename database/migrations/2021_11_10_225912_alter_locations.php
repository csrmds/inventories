<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('locations', function (Blueprint $table) {
            $table->string('name')->after('people_id');
            $table->string('description')->nullable()->change();
            $table->dropForeign('locations_product_id_foreign');
            $table->dropColumn(['product_id', 'product_qtd']);
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

        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['name']);
        });

        Schema::enableForeignKeyConstraints();
    }
}
