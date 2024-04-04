<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservations Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User ID</th>
                                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Start Address</th>
                                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">End Address</th>
                                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Distance (km)</th>
                                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Duration</th>
                                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price (€)</th>
                                <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $booking->user_id }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $booking->start_address }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $booking->end_address }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $booking->distance }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $booking->duration }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $booking->price }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <form action="{{ route('admin.update-booking-status', $booking) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="In afwachting" @if ($booking->status == 'In afwachting') selected @endif>In afwachting</option>
                                            <option value="Onderweg" @if ($booking->status == 'Onderweg') selected @endif>Onderweg</option>
                                            <option value="Afgerond" @if ($booking->status == 'Afgerond') selected @endif>Afgerond</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
