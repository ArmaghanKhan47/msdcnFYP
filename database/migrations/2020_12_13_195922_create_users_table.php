<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('CnicCardNumber')->nullable();
            $table->string('CnicFrontPic')->nullable();
            $table->string('CnicBackPic')->nullable();
            $table->string('AccountStatus')->nullable();
            $table->integer('CreditCardId')->nullable();
            $table->string('UserType');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('CreditCardId')->references('rowId')->on('credit_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
