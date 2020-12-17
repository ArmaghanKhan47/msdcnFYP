<?php

namespace Database\Factories;

use App\Models\InventoryRetailer;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryRetailerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryRetailer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = \App\Models\RetailerShop::select('RetailerShopId')->get()->toArray();
        $retailersid = array();
        foreach($data as $item)
        {
            array_push($retailersid, array_values($item)[0]);
        }

        $data = \App\Models\Medicine::select('MedicineId')->get()->toArray();
        $medicinesid = array();
        foreach($data as $item)
        {
            array_push($medicinesid, array_values($item)[0]);
        }
        return [
            'RetailerShopId' => $this->faker->randomElement($retailersid),
            'MedicineId' => $this->faker->randomElement($medicinesid),
            'Quantity' => $this->faker->randomNumber(3),
            'UnitPrice' => $this->faker->randomFloat(2, 10, 1000)
        ];
    }
}
