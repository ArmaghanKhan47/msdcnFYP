<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('retailer_id');
            $table->integer('distributor_id');
            $table->string('order_status');
            $table->string('payment_method');
            $table->double('payable_amount');
            $table->date('payed_date')->nullable();
            $table->date('order_placing_date');
            $table->date('order_completion_date')->nullable();
            $table->timestamps();

            $table->foreign('retailer_id')
            ->references('id')
            ->on('retailer_shops');

            $table->foreign('distributor_id')
            ->references('id')
            ->on('distributor_shops');
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
