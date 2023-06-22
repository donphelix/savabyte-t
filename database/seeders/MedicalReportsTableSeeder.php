<?php

namespace Database\Seeders;

use App\Models\MedicalReport;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = Ticket::all();

        foreach ($tickets as $ticket) {
            MedicalReport::factory()->count(1)->create([
                'ticket_id' => $ticket->id,
            ]);
        }
    }
}
