<?php

namespace Database\Factories;

use App\Models\DistributorShop;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistributorShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DistributorShop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = \App\Models\User::select('id')->get()->toArray();
        $users = array();
        foreach($data as $item)
        {
            array_push($users, array_values($item)[0]);
        }
        return [
            'DistributorShopName' => $this->faker->name,
            'LiscenceNo' => (String) $this->faker->unique()->randomNumber(),
            'ContactNumber' => (String) $this->faker->phoneNumber,
            'LiscenceFrontPic' => $this->faker->image,
            'Region' => 'Hazara',
            'UserId' => $this->faker->unique()->randomElement($users)
        ];
    }
}
