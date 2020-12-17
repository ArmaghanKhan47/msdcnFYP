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
        return [
            'RetailerName' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => $this->faker->password(),
            'RetailerShopName' => $this->faker->name,
            'LiscenceNo' => (String) $this->faker->randomNumber(),
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
