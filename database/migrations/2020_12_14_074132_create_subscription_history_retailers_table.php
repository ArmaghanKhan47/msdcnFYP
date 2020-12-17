<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionHistoryRetailersTable extends Migration
{
    private $primaryKey = 'HistoryId';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_history_retailers', function (Blueprint $table) {
            $table->integer('HistoryId')->autoIncrement();
            $table->integer('SubscriptionPackageId');
            $table->integer('RetailerId');
            $table->date('startDate');
            $table->timestamps();

            $table->foreign('SubscriptionPackageId')->references('PackageId')->on('subscription_packages');
            $table->foreign('RetailerId')->references('RetailerShopId')->on('retailer_shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_history_retailers');
    }
}
