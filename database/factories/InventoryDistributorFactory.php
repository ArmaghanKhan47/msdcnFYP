<?php

namespace Database\Factories;

use App\Models\InventoryDistributor;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryDistributorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryDistributor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = \App\Models\DistributorShop::select('DistributorShopId')->get()->toArray();
        $distributorsid = array();
        foreach($data as $item)
        {
            array_push($distributorsid, array_values($item)[0]);
        }

        $data = \App\Models\Medicine::select('MedicineId')->get()->toArray();
        $medicinesid = array();
        foreach($data as $item)
        {
            array_push($medicinesid, array_values($item)[0]);
        }
        return [
            'DistributorShopId' => $this->faker->randomElement($distributorsid),
            'MedicineId' => $this->faker->randomElement($medicinesid),
            'Quantity' => $this->faker->randomNumber(3),
            'UnitPrice' => $this->faker->randomFloat(2, 10, 1000)
        ];
    }
}
