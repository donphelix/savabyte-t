<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $labTests = LabTest::all();

        return view('lab_tests.index', compact('labTests'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('lab_tests.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'test_name' => 'required',
            'notes' => 'required',
            'ticket_id' =>'required'
            // Add any other validation rules here
        ]);

        // Should be coming from somewhere in the system, for now it's hard coded.
        $validatedData['fee'] = 700;

        LabTest::create($validatedData);

        return redirect()->route('tickets.show', $request->ticket_id)->with('success', 'Lab test created successfully.');
    }

    public function edit(LabTest $labTest): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('lab_tests.edit', compact('labTest'));
    }

    public function update(Request $request, LabTest $labTest): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            // Add any other validation rules here
        ]);

        $labTest->update($validatedData);

        return redirect()->route('lab_tests.index')->with('success', 'Lab test updated successfully.');
    }

    public function destroy(LabTest $labTest): RedirectResponse
    {
        $labTest->delete();

        return redirect()->route('lab_tests.index')->with('success', 'Lab test deleted successfully.');
    }
}

