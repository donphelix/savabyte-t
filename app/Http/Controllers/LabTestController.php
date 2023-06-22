<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    public function index()
    {
        $labTests = LabTest::all();

        return view('lab_tests.index', compact('labTests'));
    }

    public function create()
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

        LabTest::create($validatedData);

        return redirect()->route('tickets.show', $request->ticket_id)->with('success', 'Lab test created successfully.');
    }

    public function edit(LabTest $labTest)
    {
        return view('lab_tests.edit', compact('labTest'));
    }

    public function update(Request $request, LabTest $labTest)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            // Add any other validation rules here
        ]);

        $labTest->update($validatedData);

        return redirect()->route('lab_tests.index')->with('success', 'Lab test updated successfully.');
    }

    public function destroy(LabTest $labTest)
    {
        $labTest->delete();

        return redirect()->route('lab_tests.index')->with('success', 'Lab test deleted successfully.');
    }
}

