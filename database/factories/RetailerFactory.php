<?php

namespace Database\Factories;

use App\Models\Retailer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\String\ByteString;

class RetailerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Retailer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_name' => $this->faker->name(),
            'liscence_no' => $this->faker->numerify('#############'),
            'contact_no' => $this->faker->phoneNumber(),
            'liscence_front_pic' => $this->faker->image(),
            'region' => $this->faker->state(),
        ];
    }
}