<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_distributors', function (Blueprint $table) {
            $table->id();
            $table->integer('distributor_id');
            $table->integer('medicine_id');
            $table->integer('quantity');
            $table->double('unit_price');
            $table->timestamps();

            $table->foreign('distributor_id')
            ->references('id')
            ->on('distributor_shops')
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
        Schema::dropIfExists('inventory_distributors');
    }
}
