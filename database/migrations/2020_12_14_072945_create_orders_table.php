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
            $table->unsignedBigInteger('retailer_id');
            $table->unsignedBigInteger('distributor_id');
            $table->boolean('is_accepted')->default(false);
            $table->boolean('is_cancelled')->default(false);
            $table->boolean('is_dispatched')->default(false);
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->string('payment_method');
            $table->double('payable_amount');
            $table->date('payed_date')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
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
