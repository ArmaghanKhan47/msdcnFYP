<?php

namespace Database\Factories;

use App\Models\SubscriptionHistoryRetailer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionHistoryRetailerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriptionHistoryRetailer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = \App\Models\RetailerShop::select('RetailerShopId')->get()->toArray();
        $new = array();
        foreach($data as $item)
        {
            array_push($new, array_values($item)[0]);
        }

        $data = \App\Models\SubscriptionPackage::select('PackageId')->get()->toArray();
        $new2 = array();
        foreach($data as $item)
        {
            array_push($new2, array_values($item)[0]);
        }

        return [
            'SubscriptionPackageId' => $this->faker->randomElement($new2),
            'RetailerId' => $this->faker->randomElement($new),
            'startDate' => $this->faker->date()
        ];
    }
}
