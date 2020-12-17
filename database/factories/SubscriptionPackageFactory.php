<?php

namespace Database\Factories;

use App\Models\SubscriptionPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionPackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriptionPackage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'PackageName' => $this->faker->name,
            'PackagePrice' => (double) $this->faker->randomFloat(),
            'PackageDuration' => $this->faker->randomDigit,
        ];
    }
}
