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
            $table->string('DistributorShopName');
            $table->string('LiscenceNo')->unique();
            $table->string('ContactNumber');
            $table->string('LiscenceFrontPic');
            $table->string('Region');
            $table->bigInteger('UserId')->unsigned();
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
        Schema::dropIfExists('distributor_shops');
    }
}
