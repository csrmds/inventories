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
            $table->dropForeign('locations_product_id_foreign');
            $table->dropColumn(['product_qtd', 'product_id']);
            $table->string('name')->after('people_id');
            $table->string('hierarchy')->nullable()->after('description');
            $table->string('description')->nullable()->change();
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
            $table->dropColumn(['name', 'hierarchy']);
            $table->foreignId('product_id')->constrained('products')->nullable();
            $table->decimal('product_qtd')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }
}
