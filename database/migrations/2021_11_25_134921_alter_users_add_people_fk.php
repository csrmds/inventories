<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddPeopleFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('people_id')->nullable()->constrained('people')->after('id');
            $table->string('ldap_guid')->unique()->nullable()->after('remember_token');
            $table->string('ldap_domain')->nullable()->after('ldap_guid');
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

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('people_id');
            $table->dropColumn('ldap_guid');
            $table->dropColumn('ldap_domain');
        });

        Schema::enableForeignKeyConstraints();
    }
}
