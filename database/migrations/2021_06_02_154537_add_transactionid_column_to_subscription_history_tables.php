<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionidColumnToSubscriptionHistoryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_history_distributors', function (Blueprint $table) {
            //Adding Transaction Id Column to Subscription History Distributors Table
            $table->bigInteger('TransactionId')->after('startDate');
        });

        Schema::table('subscription_history_retailers', function (Blueprint $table) {
            //Adding Transaction Id Column to Subscription History Retailer Table
            $table->bigInteger('TransactionId')->after('startDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_history_distributors', function (Blueprint $table) {
            //Removing Transaction Id Column from Subscription History Distributor Table
            $table->dropColumn('TransactionId');
        });

        Schema::table('subscription_history_retailers', function (Blueprint $table) {
            //Removing Transaction Id Column from Subscription History Retailer Table
            $table->dropColumn('TransactionId');
        });
    }
}
