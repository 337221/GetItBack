<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Start Address</th>
            <th>End Address</th>
            <th>Distance (km)</th>
            <th>Duration</th>
            <th>Price (€)</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userBookings as $booking)
            <tr>
                <td>{{ $booking->user_id }}</td>
                <td>{{ $booking->start_address }}</td>
                <td>{{ $booking->end_address }}</td>
                <td>{{ $booking->distance }}</td>
                <td>{{ $booking->duration }}</td>
                <td>{{ $booking->price }}</td>
                <td>{{ $booking->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
