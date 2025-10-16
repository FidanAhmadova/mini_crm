<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Deal::class;
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'title' => fake()->sentence(),
            'amount' => fake()->randomFloat(2, 1000, 100000),
            'status' => fake()->randomElement(['new', 'in_progress', 'won', 'lost']),
        ];
    }
}
