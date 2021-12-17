<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionHistoryRetailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_history_retailers', function (Blueprint $table) {
            $table->id();
            $table->integer('subscription_package_id');
            $table->integer('retailer_id');
            $table->date('start_date');
            $table->timestamps();

            $table->foreign('subscription_package_id')
            ->references('id')
            ->on('subscription_packages');

            $table->foreign('retailer_id')
            ->references('id')
            ->on('retailer_shops');
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
