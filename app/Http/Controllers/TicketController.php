<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
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
        return view('tickets.show', compact('ticket'));
    }
}

