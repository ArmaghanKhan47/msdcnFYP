<?php

namespace Database\Seeders;

use App\Models\PointOfSaleRetailerRecord;
use Illuminate\Database\Seeder;

class PointOfSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PointOfSaleRetailerRecord::create([
            'RetailerShopId' => 11,
            'DailyRevenue' => rand(500, 10000)
        ]);

        PointOfSaleRetailerRecord::create([
            'RetailerShopId' => 11,
            'DailyRevenue' => rand(500, 10000)
        ]);
        PointOfSaleRetailerRecord::create([
            'RetailerShopId' => 11,
            'DailyRevenue' => rand(500, 10000)
        ]);
        PointOfSaleRetailerRecord::create([
            'RetailerShopId' => 11,
            'DailyRevenue' => rand(500, 10000)
        ]);
        PointOfSaleRetailerRecord::create([
            'RetailerShopId' => 11,
            'DailyRevenue' => rand(500, 10000)
        ]);
        PointOfSaleRetailerRecord::create([
            'RetailerShopId' => 11,
            'DailyRevenue' => rand(500, 10000)
        ]);
        PointOfSaleRetailerRecord::create([
            'RetailerShopId' => 11,
            'DailyRevenue' => rand(500, 10000)
        ]);
        PointOfSaleRetailerRecord::create([
            'RetailerShopId' => 11,
            'DailyRevenue' => rand(500, 10000)
        ]);
    }
}
