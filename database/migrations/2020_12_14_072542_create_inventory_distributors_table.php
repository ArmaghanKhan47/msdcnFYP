<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryDistributorsTable extends Migration
{
    private $primaryKey = "InventoryId";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_distributors', function (Blueprint $table) {
            $table->integer('InventoryId')->autoIncrement();
            $table->integer('DistributorShopId');
            $table->integer('MedicineId');
            $table->integer('Quantity');
            $table->double('UnitPrice');
            $table->timestamps();

            $table->foreign('DistributorShopId')->references('DistributorShopId')->on('distributor_shops');
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
        Schema::dropIfExists('inventory_distributors');
    }
}
