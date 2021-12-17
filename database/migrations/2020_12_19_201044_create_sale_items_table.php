<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id');
            $table->integer('medicine_id');
            $table->integer('quantity');
            $table->double('sub_total');
            $table->timestamps();

            $table->foreign('sale_id')
            ->references('id')
            ->on('sales');

            $table->foreign('medicine_id')
            ->references('id')
            ->on('medicines');
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
