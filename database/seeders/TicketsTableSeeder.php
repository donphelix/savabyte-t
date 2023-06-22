<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();

        foreach ($patients as $patient) {
            Ticket::factory()->count(1)->create([
                'patient_id' => $patient->id,
                'user_id' => 1, // Replace with desired user_id value
            ]);
        }
    }
}
