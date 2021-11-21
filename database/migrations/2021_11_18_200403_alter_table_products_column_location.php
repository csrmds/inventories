<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProductsColumnLocation extends Migration
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
            $table->foreignId('location_id')->nullable()->constrained('locations');
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
            $table->dropForeign('location_id');
            $table->dropColumn('location_id');
        });

        Schema::enableForeignKeyConstraints();
    }
}
