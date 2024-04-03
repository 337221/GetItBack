<!-- <script src="https://maps.googleapis.com/maps/api/js?key=XD&libraries=places&callback=initAutocomplete" async defer></script> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rit Boeken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('calculate-distance') }}" method="POST">
                        @csrf
                        <label for="start">Start Adres:</label>
                        <br>
                        <input id="start_address" name="start" type="text" required style="color: black;">
                        <br><br>
                        <label for="start">Eind Adres:</label>
                        <br>
                        <input id="end_address" name="end" type="text" required style="color: black;">
                        <br><br>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Boek Rit
                        </button>
                    </form>

                    @if (session('distance'))
                        <div class="mt-4">
                            <p>Afstand: {{ session('distance') }} km</p>
                            <p>Tijdsduur: {{ session('duration') }}</p>
                            <p>Prijs: €{{ session('price') }}</p>

                            <form action="{{ route('book-ride') }}" method="POST">
                                @csrf
                                <input type="hidden" name="start" value="{{ session('start') }}">
                                <input type="hidden" name="end" value="{{ session('end') }}">
                                <input type="hidden" name="distance" value="{{ session('distance') }}">
                                <input type="hidden" name="duration" value="{{ session('duration') }}">
                                <input type="hidden" name="price" value="{{ session('price') }}">
                                <br>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Bevestig rit
                                </button>
                                
                            </form>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mt-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- <script>
    function initAutocomplete() {
        const startAutocomplete = new google.maps.places.Autocomplete(
            document.getElementById('start_address'),
            { types: ['geocode'] }
        );

        const endAutocomplete = new google.maps.places.Autocomplete(
            document.getElementById('end_address'),
            { types: ['geocode'] }
        );

        startAutocomplete.setFields(['address_component']);
        endAutocomplete.setFields(['address_component']);

        startAutocomplete.addListener('place_changed', function() {
            const place = startAutocomplete.getPlace();
            console.log(place);
        });

        endAutocomplete.addListener('place_changed', function() {
            const place = endAutocomplete.getPlace();
            console.log(place);
        });
    }
</script> -->
