<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     */
    protected $model = Company::class;
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'number' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'address' => fake()->address(),
        ];
    }
}
