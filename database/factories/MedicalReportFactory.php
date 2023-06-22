<?php

namespace Database\Factories;

use App\Models\MedicalReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalReport>
 */
class MedicalReportFactory extends Factory
{

    protected $model = MedicalReport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'diagnosis' => $this->faker->text,
            'prescription' => $this->faker->text,
            'fee' => $this->faker->numberBetween(500, 1),
            // Add additional fields if necessary
        ];
    }
}
