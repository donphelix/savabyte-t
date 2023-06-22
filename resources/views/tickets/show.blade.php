<!-- register-patients.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Patient Name: {{ $ticket->patient->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Display Success Message -->
                    @if (session('success'))
                        <div x-data="{ show: true }"
                             x-init="setTimeout(() => { show = false }, 3000)"
                             x-show="show"
                             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                             role="alert"
                        >
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">
                                {{ __('Please fix the following errors:') }}
                            </div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="container mx-auto py-8">
                        <div class="mb-6 flex items-center justify-between">
                            <h2 class="text-2xl font-bold">Ticket Details</h2>
                        </div>

                        <div class="bg-white rounded-lg shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-bold mb-4">Ticket Information</h3>
                                <p><strong>Ticket Number:</strong> {{ $ticket->ticket_number }}</p>
                                <p><strong>Patient Name:</strong> {{ $ticket->patient->name }}</p>
                                <p><strong>Fee:</strong> {{ $ticket->fee }}</p>
                                <p><strong>Checked In:</strong> {{ $ticket->checked_in_at ? 'Yes' : 'No' }}</p>
                                <p><strong>Date:</strong> {{ $ticket->created_at->format('Y-m-d H:i:s') }}</p>
                                <br />
                                <hr />

                                <h3 class="text-lg font-bold mt-6 mb-4">Lab Tests</h3>
                                @if (isset($ticket->lab_tests))
                                    <ul>
                                        <li>
                                            <span class="font-semibold">Test Name:</span> {{ $ticket->lab_tests->test_name }}
                                        </li>
                                        <li>
                                            <span class="font-semibold">Specialist Notes:</span> {{ $ticket->lab_tests->notes }}
                                        </li>
                                        <li>
                                            <span class="font-semibold">Amount:</span> {{ $ticket->lab_tests->fee }}</li>
                                    </ul>
                                @else
                                    <p>Lab test is in process, please wait</p>
                                    <div x-data="{ open: false }">
                                        <!-- Modal Button -->
                                        <button type="button" class="px-4 py-2 bg-blue-500 text-white rounded" @click="open = true">Add Lab test</button>

                                        <!-- Modal Overlay -->
                                        <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 w-1/2 mx-auto">
                                            <!-- Modal Content -->
                                            <div class="bg-white rounded-lg shadow-lg p-6 w-1/2 mx-auto">
                                                <!-- Modal Close Button -->
                                                <button type="button" class="absolute top-0 right-0 m-4 text-gray-500" @click="open = false">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>

                                                <!-- Modal Content Here -->
                                                <h3 class="text-lg font-bold mb-4">Add Lab Test</h3>
                                                <div class="w-1/2 mx-auto">
                                                    <form action="{{ route('lab_tests.store') }}" method="POST">
                                                        @csrf

                                                        <div class="mb-4">
                                                            <label for="name" class="block text-gray-700 font-bold mb-2">Test Name</label>
                                                            <input type="text" id="name" name="test_name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500" placeholder="Enter your name" required>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="notes" class="block text-gray-700 font-bold mb-2">Notes</label>
                                                            <textarea id="notes" name="notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500" placeholder="Enter your notes" required></textarea>
                                                        </div>
                                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

                                                        <div class="flex justify-end">
                                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endif

                                <br/>
                                <hr />

                                <h3 class="text-lg font-bold mt-6 mb-4">Medical Reports</h3>
                                @if (isset($ticket->medical_reports))
                                    <ul>
                                        <li>
                                            <span class="font-semibold">Diagnosis:</span> {{ $ticket->medical_reports->diagnosis }}
                                        </li>
                                        <li>
                                            <span class="font-semibold">Prescription:</span> {{ $ticket->medical_reports->prescription }}
                                        </li>

                                        <li>
                                            <span class="font-semibold">Amount:</span> {{ $ticket->medical_reports->fee }}
                                        </li>
                                    </ul>
                                @else
                                    <p>No medical reports found, please create one</p>
                                    <div x-data="{ open: false }">
                                        <!-- Modal Button -->
                                        <button type="button" class="px-4 py-2 bg-blue-500 text-white rounded" @click="open = true">Add Medical Report</button>

                                        <!-- Modal Overlay -->
                                        <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 w-1/2 mx-auto">
                                            <!-- Modal Content -->
                                            <div class="bg-white rounded-lg shadow-lg p-6 w-1/2 mx-auto">
                                                <!-- Modal Close Button -->
                                                <button type="button" class="absolute top-0 right-0 m-4 text-gray-500" @click="open = false">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>

                                                <!-- Modal Content Here -->
                                                <h3 class="text-lg font-bold mb-4">Add Prescription</h3>
                                                <div class="w-1/2 mx-auto">
                                                    <form action="{{ route('medical_reports.store') }}" method="POST">
                                                        @csrf

                                                        <div class="mb-4">
                                                            <label for="name" class="block text-gray-700 font-bold mb-2">Diagnosis</label>
                                                            <input type="text" id="diagnosis" name="diagnosis" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500" placeholder="Enter your name" required>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="notes" class="block text-gray-700 font-bold mb-2">Prescription</label>
                                                            <textarea id="prescription" name="prescription" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500" placeholder="Enter your notes" required></textarea>
                                                        </div>
                                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

                                                        <div class="flex justify-end">
                                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Calculate Amount -->
                    <div class="mt-6">
                        <h3 class="text-lg font-bold mb-4">Amount</h3>
                        <p><strong>Total Amount:</strong> KSH
                            @if (isset($ticket->fee) && isset($ticket->lab_tests) && isset($ticket->medical_reports))
                                {{ $ticket->fee + $ticket->lab_tests->fee + $ticket->medical_reports->fee }}
                            @else
                                Coming soon
                            @endif
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
