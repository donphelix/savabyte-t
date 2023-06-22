<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $patients = $user->patients;

        return view('patients.index', compact('patients'));
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
        ]);

        $user = Auth::user();
        $patient = $user->patients()->create($validatedData);

        // Generate ticket for this specific patient.

        $ticket = Ticket::create([
            'patient_id' => $patient->id,
            'user_id' => $user->id,
            'checked_in_at' => now(),
            'ticket_number' => Ticket::generateTicketNumber(), // Custom function to generate a unique ticket number.
        ]);

        // Send ticket to doctors dashboard.

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    public function edit(Patient $patient): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
        ]);

        $patient->update($validatedData);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }

    private function generateTicketNumber()
    {

    }
}
