<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorShopsTable extends Migration
{
    private $primaryKey = "DistributorShopId";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_shops', function (Blueprint $table) {
            $table->integer('DistributorShopId')->autoIncrement();
            $table->string('DistributorName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('DistributorShopName');
            $table->string('LiscenceNo')->unique();
            $table->string('CnicCardNumber')->unique();
            $table->string('ContactNumber')->unique();
            $table->binary('CnicFrontPic');
            $table->binary('CnicBackPic');
            $table->binary('LiscenceFrontPic');
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
        Schema::dropIfExists('distributor_shops');
    }
}
