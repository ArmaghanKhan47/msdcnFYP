<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryRetailersTable extends Migration
{
    private $primaryKey = "InventoryId";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_retailers', function (Blueprint $table) {
            $table->integer('InventoryId')->autoIncrement();
            $table->integer('RetailerShopId');
            $table->integer('MedicineId');
            $table->integer('Quantity');
            $table->double('UnitPrice');
            $table->timestamps();

            $table->foreign('RetailerShopId')->references('RetailerShopId')->on('retailer_shops');
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
        Schema::dropIfExists('inventory_retailers');
    }
}
