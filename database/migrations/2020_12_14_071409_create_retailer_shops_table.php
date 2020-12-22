<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailerShopsTable extends Migration
{
    private $primaryKey = "RetailerShopId";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retailer_shops', function (Blueprint $table) {
            $table->integer('RetailerShopId')->autoIncrement();
            $table->string('RetailerShopName');
            $table->string('LiscenceNo')->unique();
            $table->string('LiscenceFrontPic');
            $table->string('Region');
            $table->bigInteger('UserId')->unsigned();
            $table->string('ContactNumber');
            $table->timestamps();

            $table->foreign('UserId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retailer_shops');
    }
}
