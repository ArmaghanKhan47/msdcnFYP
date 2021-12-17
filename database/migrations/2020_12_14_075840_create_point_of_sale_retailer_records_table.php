<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointOfSaleRetailerRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_sale_retailer_records', function (Blueprint $table) {
            $table->id();
            $table->integer('retailer_id');
            $table->double('daily_revenue');
            $table->timestamps();

            $table->foreign('retailer_id')
            ->references('id')
            ->on('retailer_shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_of_sale_retailer_records');
    }
}
