<!-- register-patients.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto py-8">
                        <h2 class="text-2xl font-bold mb-4">Tickets</h2>

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

                        <!-- Patient registration form -->
                        <!-- Ticket table -->
                        <table class="w-full bg-white border border-gray-300">
                            <thead>
                            <tr>
                                <th class="px-4 py-2 font-medium text-left">Patient Name</th>
                                <th class="px-4 py-2 font-medium text-left">Ticket Number</th>
                                <th class="px-4 py-2 font-medium text-left">Date</th>
                                <th class="px-4 py-2 font-medium text-left">Status</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td class="border px-4 py-2">{{ $ticket->patient->name }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->ticket_number }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->checked_in_at ? 'Checked In' : 'Not Checked In' }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('tickets.show', $ticket->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">View more</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

