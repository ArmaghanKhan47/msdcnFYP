<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    private $primaryKey = 'TransactionId';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('TransactionId')->autoIncrement();
            $table->integer('OrderId');
            $table->string('PaymentMethod');
            $table->double('PayableAmount');
            $table->date('PayedDate');
            $table->timestamps();

            $table->foreign('OrderId')->references('OrderId')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
