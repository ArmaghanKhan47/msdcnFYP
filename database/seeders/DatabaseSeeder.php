<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseSeeder extends Seeder
{
    use RefreshDatabase;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Medicine::factory(10)->create();
        \App\Models\SubscriptionPackage::factory(5)->create();
        \App\Models\RetailerShop::factory(10)->create();
        \App\Models\DistributorShop::factory(10)->create();
        \App\Models\SubscriptionHistoryRetailer::factory(20)->create();
        \App\Models\SubscriptionHistoryDistributor::factory(20)->create();
        \App\Models\InventoryRetailer::factory(30)->create();
        \App\Models\InventoryDistributor::factory(30)->create();
    }
}
