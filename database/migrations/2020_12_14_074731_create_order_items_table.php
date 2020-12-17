<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    private $primaryKey = 'ItemId';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('ItemId')->autoIncrement();
            $table->integer('OrderId');
            $table->integer('MedicineId');
            $table->integer('Quantity');
            $table->double('Subtotal');
            $table->timestamps();

            $table->foreign('OrderId')->references('OrderId')->on('orders');
            $table->foreign('MedicineId')->references('MedicineId')->on('medicines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
