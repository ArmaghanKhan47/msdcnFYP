<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    private $timestamp = false;
    private $primaryKey = "OrderId";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('OrderId')->autoIncrement();
            $table->integer('RetailerId');
            $table->integer('DistributorId');
            $table->string('OrderStatus');
            $table->integer('OrderId');
            $table->string('PaymentMethod');
            $table->double('PayableAmount');
            $table->date('PayedDate');
            $table->date('OrderPlacingDate');
            $table->date('OrderCompletionDate');

            $table->foreign('RetailerId')->references('RetailerShopId')->on('retailer_shops');
            $table->foreign('DistributorId')->references('DistributorShopId')->on('distributor_shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
