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
            $table->string('RetailerName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('RetailerShopName');
            $table->string('LiscenceNo')->unique();
            $table->string('CnicCardNumber')->unique();
            $table->string('ContactNumber')->unique();
            $table->string('CnicFrontPic');
            $table->string('CnicBackPic');
            $table->string('LiscenceFrontPic');
            $table->integer('CreditCardDetail');
            $table->string('AccountStatus');
            $table->string('Region');
            $table->timestamps();

            $table->foreign('CreditCardDetail')->references('rowId')->on('credit_cards');
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
