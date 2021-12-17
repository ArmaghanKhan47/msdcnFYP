<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionHistoryDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_history_distributors', function (Blueprint $table) {
            $table->id();
            $table->integer('subscription_package_id');
            $table->integer('distributor_id');
            $table->date('start_date');
            $table->timestamps();

            $table->foreign('subscription_package_id')
            ->references('id')
            ->on('subscription_packages');

            $table->foreign('distributor_id')
            ->references('id')
            ->on('distributor_shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_history_distributors');
    }
}
