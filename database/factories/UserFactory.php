<?php

namespace Database\Factories;

use App\Enums\AccountStatus;
use App\Models\Distributor;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'account_status' => AccountStatus::$PENDING,
            'cnic_front_pic' => $this->faker->imageUrl(),
            'cnic_back_pic' => $this->faker->imageUrl(),
            'cnic_card_no' => $this->faker->unique()->numerify('################'),
        ];
    }

    public function distributor(){
        return $this->state(function($attributes){
            return [
                'userable_id' => Distributor::factory(),
                'userable_type' => 'App\Models\Distributor'
            ];
        });
    }

    public function retailer(){
        return $this->state(function($attributes){
            return [
                'userable_id' => Retailer::factory(),
                'userable_type' => 'App\Models\Distributor'
            ];
        });
    }

    public function active(){
        return $this->state(function($attributes){
            return [
                'account_status' => AccountStatus::$ACTIVE
            ];
        });
    }

    public function pending(){
        return $this->state(function($attributes){
            return [
                'account_status' => AccountStatus::$PENDING
            ];
        });
    }

    public function deactive(){
        return $this->state(function($attributes){
            return [
                'account_status' => AccountStatus::$DEACTIVE
            ];
        });
    }
}
