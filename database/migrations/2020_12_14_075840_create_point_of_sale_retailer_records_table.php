<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointOfSaleRetailerRecordsTable extends Migration
{
    private $primaryKey = 'RecordId';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_sale_retailer_records', function (Blueprint $table) {
            $table->integer('RecordId')->autoIncrement();
            $table->integer('RetailerShopId');
            $table->double('DailyRevenue');
            $table->timestamps();
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
