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
        \App\Models\User::factory(5)->distributor()->create();
        \App\Models\User::factory(5)->retailer()->create();
        $this->call(AdminUserSeeder::class);
        // \App\Models\Medicine::factory(10)->create();
    }
}
