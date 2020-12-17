<?php

namespace Database\Factories;

use App\Models\CreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CreditCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "CardNumber" => $this->faker->creditCardNumber,
            "ExpiryMonth" => $this->faker->randomDigit(),
            "ExpiryYear" => $this->faker->randomDigit(),
            "cvv" => $this->faker->randomNumber()
        ];
    }
}
