<!-- lab-test-results.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold mb-4">Lab Test Results</h2>

        <!-- Lab test results -->
        @foreach ($tickets as $ticket)
            <div class="mb-4">
                <h3 class="text-lg font-semibold">{{ $ticket->patient->name }}</h3>
                <p>Lab Test: {{ $ticket->labTest->name }}</p>
                <p>Results: {{ $ticket->labTest->results }}</p>
            </div>
        @endforeach
    </div>
@endsection
