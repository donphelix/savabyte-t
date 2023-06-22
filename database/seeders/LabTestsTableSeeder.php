<?php

namespace Database\Seeders;

use App\Models\LabTest;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabTestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tickets = Ticket::all();

        foreach ($tickets as $ticket) {
            LabTest::factory()->count(1)->create([
                'ticket_id' => $ticket->id,
            ]);
        }
    }
}
