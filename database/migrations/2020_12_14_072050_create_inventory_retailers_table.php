<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryRetailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_retailers', function (Blueprint $table) {
            $table->id();
            $table->integer('retailer_id');
            $table->integer('medicine_id');
            $table->integer('quantity');
            $table->double('unit_price');
            $table->timestamps();

            $table->foreign('retailer_id')
            ->references('id')
            ->on('retailer_shops')
            ->onDelete('cascade');
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
