<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <div class="mt-4">
                        @if (auth()->user()->is_admin)
                            <a href="{{ url('/admin/dashboard') }}" class="text-lg text-blue-500 hover:text-blue-700">Go to Admin Dashboard</a><br>
                            <a href="{{ url('/admin/reservations') }}" class="text-lg text-blue-500 hover:text-blue-700">View Admin Reservations</a><br>
                        @endif

                        <a href="{{ url('/book-a-ride') }}" class="text-lg text-blue-500 hover:text-blue-700">Book a Ride</a><br>
                        <a href="{{ url('/ride-history') }}" class="text-lg text-blue-500 hover:text-blue-700">View Ride History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
