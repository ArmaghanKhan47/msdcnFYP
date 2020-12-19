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
        return [
            'DistributorName' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => $this->faker->password(),
            'DistributorShopName' => $this->faker->name,
            'LiscenceNo' => (String) $this->faker->unique()->randomNumber(),
            'CnicCardNumber' => (String) $this->faker->unique()->randomNumber(),
            'ContactNumber' => (String) $this->faker->phoneNumber,
            'CnicFrontPic' => $this->faker->image,
            'CnicBackPic' => $this->faker->image,
            'LiscenceFrontPic' => $this->faker->image,
            'AccountStatus' => 'ACTIVE',
            'Region' => 'Hazara',
            'CreditCardDetail' => function(){
                return \App\Models\CreditCard::factory()->create()->id;
            }
        ];
    }
}
