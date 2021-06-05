<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoColumnsToAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            //Add these fields for company mobile payment accounts
            $table->string('account_provider')->after('password')->nullable();
            $table->string('qr_code')->after('account_provider')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            //Remove Added fields
            $table->dropColumn('account_provider');
            $table->dropColumn('qr_code');
        });
    }
}
