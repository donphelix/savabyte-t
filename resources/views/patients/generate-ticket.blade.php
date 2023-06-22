<!-- generate-ticket.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold mb-4">Register Patient</h2>

        <!-- Patient registration form -->
        <form class="max-w-md mx-auto" action="{{ route('patients.store') }}" method="POST">
            @csrf

            <!-- Form fields -->
            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Name</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="Enter patient name" required>
            </div>

            <div class="mb-4">
                <label for="age" class="block font-medium mb-1">Age</label>
                <input type="number" id="age" name="age" class="form-input" placeholder="Enter patient age" required>
            </div>

            <!-- Submit button -->
            <div>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
@endsection

