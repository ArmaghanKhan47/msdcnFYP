<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    private $primaryKey = 'SaleId';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->integer('SaleId')->autoIncrement();
            $table->integer('PointOfSaleId');
            $table->double('Total');
            $table->double('Discount');
            $table->double('Payed');
            $table->timestamps();

            $table->foreign('PointOfSaleId')->references('RecordId')->on('point_of_sale_retailer_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
