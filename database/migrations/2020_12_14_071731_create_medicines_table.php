<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    private $primaryKey = "MedicineId";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->integer('MedicineId')->autoIncrement();
            $table->string('MedicineName');
            $table->json('MedicineFormula');
            $table->string('MedicineCompany');
            $table->string('MedicineType');
            $table->string('MedicinePic');
            $table->longText('MedicineDiscription');
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
        Schema::dropIfExists('medicines');
    }
}
