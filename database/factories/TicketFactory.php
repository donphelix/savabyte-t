<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{

    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_number' => $this->faker->unique()->randomNumber(6),
            'checked_in_at' => $this->faker->dateTime(),
            'patient_id' => 1, // Replace with desired patient_id value
            'user_id' => 1, // Replace with desired user_id value
            // Add additional fields if necessary
        ];
    }
}
