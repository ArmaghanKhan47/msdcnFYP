<?php

namespace Database\Factories;

use App\Models\RetailerShop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\String\ByteString;

class RetailerShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RetailerShop::class;

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
            'RetailerShopName' => $this->faker->name,
            'LiscenceNo' => (String) $this->faker->randomNumber(),
            'ContactNumber' => (String) $this->faker->phoneNumber,
            'LiscenceFrontPic' => $this->faker->image,
            'Region' => 'Hazara',
            'UserId' => $this->faker->unique()->randomElement($users)
        ];
    }
}
