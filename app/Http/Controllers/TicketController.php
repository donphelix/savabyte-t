<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Models\Patient;
use App\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $tickets = $user->tickets()->with('patient')->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patients = Patient::all();

        return view('tickets.create', compact('patients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
        ]);

        Ticket::create($validatedData);

        return redirect()->route('tickets.index')->with('success', 'Ticket generated successfully.');
    }

    public function show(Ticket $ticket): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $ticket->with('lab_tests', 'medical_reports');
//            $lab_tests = LabTest::where('ticket_id', $ticket->id)->get();
//            dd($lab_tests);

        return view('tickets.show', compact('ticket'));
    }
}

