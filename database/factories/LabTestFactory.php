<?php

namespace Database\Factories;

use App\Models\LabTest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabTest>
 */
class LabTestFactory extends Factory
{

    protected $model = LabTest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'test_name' => $this->faker->word,
            'notes' => $this->faker->sentence(20),
            'fee' => $this->faker->numberBetween(500, 1)
            // Add additional fields if necessary
        ];
    }
}
