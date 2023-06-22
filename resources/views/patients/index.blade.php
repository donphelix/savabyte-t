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

                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-2xl font-bold">Patient List</h2>
                        <a href="{{ route('patients.create') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Create Patient</a>
                    </div>

                    <!-- Patient table -->
                    <table class="w-full bg-white border border-gray-300">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 font-medium text-left">Name</th>
                            <th class="px-4 py-2 font-medium text-left">Age</th>
                            <th class="px-4 py-2 font-medium text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($patients as $patient)
                            <tr>
                                <td class="border px-4 py-2">{{ $patient->name }}</td>
                                <td class="border px-4 py-2">{{ $patient->age }}</td>
                                <td class="border px-4 py-2">
                                    <button class="bg-blue-500">
                                        View
                                    </button>
                                </td>
                                <td class="border px-4 py-2">
                                    <button class="">
                                        Edit
                                    </button>
                                </td>
                                <td class="border px-4 py-2">
                                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        <span>Delete</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-2 text-center">No patients found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
