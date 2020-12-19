<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medicine::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "MedicineName" => $this->faker->name,
            "MedicineFormula" => json_encode([$this->faker->name, $this->faker->name]),
            "MedicineCompany" => $this->faker->name,
            "MedicineType" => $this->faker->randomElement(["Tablets", "Drips", "Syrup", "Vial"]),
            "MedicinePic" => $this->faker->image
        ];
    }
}
