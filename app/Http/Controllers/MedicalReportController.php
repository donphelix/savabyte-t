<?php

namespace App\Http\Controllers;

use App\Models\MedicalReport;
use App\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MedicalReportController extends Controller
{
    public function create(Ticket $ticket): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('medical_reports.create', compact('ticket'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'ticket_id' => 'required',
            'diagnosis' => 'required',
            'prescription' => 'required',
        ]);

        MedicalReport::create($validatedData);

        return redirect()->route('tickets.show', $request->ticket_id)->with('success', 'Lab test created successfully.');
    }

    public function edit(MedicalReport $medicalReport): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('medical_reports.edit', compact('medicalReport'));
    }

    public function update(Request $request, MedicalReport $medicalReport): RedirectResponse
    {
        $validatedData = $request->validate([
            'diagnosis' => 'required',
            'prescription' => 'required',
        ]);

        $medicalReport->update($validatedData);

        return redirect()->route('tickets.index')->with('success', 'Medical report updated successfully.');
    }

    public function destroy(MedicalReport $medicalReport): RedirectResponse
    {
        $medicalReport->delete();

        return redirect()->route('tickets.index')->with('success', 'Medical report deleted successfully.');
    }
}

