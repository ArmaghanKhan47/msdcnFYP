<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    private $primaryKey = 'SaleItemId';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->integer('SaleItemId')->autoIncrement();
            $table->integer('SaleId');
            $table->integer('MedicineId');
            $table->integer('Quantity');
            $table->double('SubTotal');
            $table->timestamps();

            $table->foreign('SaleId')->references('SaleId')->on('sales');
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
        Schema::dropIfExists('sale_items');
    }
}
