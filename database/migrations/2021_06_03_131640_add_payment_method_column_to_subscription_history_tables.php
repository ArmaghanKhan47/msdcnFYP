<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentMethodColumnToSubscriptionHistoryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_history_distributors', function (Blueprint $table) {
            //Adding Payment Method Column to Subscription History Distributors Table
            $table->string('payment_method')->after('transaction_id');
        });

        Schema::table('subscription_history_retailers', function (Blueprint $table) {
            //Adding Payment Method Column to Subscription History Retailer Table
            $table->string('payment_method')->after('transaction_id');
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
            //Removing Payment Method Column from Subscription History Distributors Table
            $table->dropColumn('payment_method');
        });

        Schema::table('subscription_history_retailers', function (Blueprint $table) {
            //Removing Payment Method Column from Subscription History Retailer Table
            $table->dropColumn('payment_method');
        });
    }
}
