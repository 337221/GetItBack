<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use App\Models\RideBooking;

class DistanceController extends Controller
{
    public function index()
    {
        return view('rit-boeken');
    }

    public function calculate(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $apiKey = env('GOOGLE_MAPS_API_KEY');
    
        $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json", [
            'origins' => $start,
            'destinations' => $end,
            'units' => 'metric',
            'language' => 'nl',
            'key' => $apiKey,
        ]);
    
        if ($response->successful()) {
            $data = $response->json();
            $element = $data['rows'][0]['elements'][0];
            if ($element['status'] == 'ZERO_RESULTS' || $element['status'] == 'NOT_FOUND') {
                return back()->withErrors('Er kon geen route worden gevonden tussen de opgegeven locaties. Voer geldige locaties in.');
            }
    
            $distanceValue = $data['rows'][0]['elements'][0]['distance']['value'] / 1000;
            $duration = $data['rows'][0]['elements'][0]['duration']['text'];
            $pricePerKm = Setting::where('key', 'price_per_km')->value('value');
            $totalPrice = $distanceValue * $pricePerKm;
    
            return back()->with([
                'start' => $start,
                'end' => $end,
                'distance' => $distanceValue,
                'duration' => $duration,
                'price' => $totalPrice,
            ]);
        } else {
            return back()->withErrors('Kan de afstand niet berekenen. Voer een geldig adres in.');
        }
    }

    public function bookRide(Request $request)
    {
        $validated = $request->validate([
            'start' => 'required',
            'end' => 'required',
            'distance' => 'required|numeric',
            'duration' => 'required',
            'price' => 'required|numeric',
        ]);
    
        $booking = new RideBooking();
        $booking->user_id = auth()->id();
        $booking->start_address = $validated['start'];
        $booking->end_address = $validated['end'];
        $booking->distance = $validated['distance'];
        $booking->duration = $validated['duration'];
        $booking->price = $validated['price'];
        $booking->save();
    
        return back()->with('success', 'Uw rit is succesvol geboekt.');
    }
    
}
