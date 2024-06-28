<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BrandCar;
use App\Models\Car;
use App\Models\CarLocation;
use App\Models\Location;
use App\Models\Payment;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Stevebauman\Location\Facades\Location as LocationFacade;

class FrontendController extends Controller
{
    public function splash()
    {
        return view('frontend.splash');
    }

    public function index()
    {
        return view('frontend.home', [
            'brands' => BrandCar::all(),
            'cars' => Car::all(),
            'mylocation' => LocationFacade::get(),
        ]);
    }

    public function detail(Car $car)
    {
        return view('frontend.detail', [
            'car' => $car,
        ]);
    }

    public function checkout(Car $car)
    {
        return view('frontend.checkout', [
            'car' => $car,
            'mylocation' => LocationFacade::get(),
            'locations' => CarLocation::with('location')
                ->where('car_id', $car->id)
                ->get()
                ->unique('location_id'),
        ]);
    }

    public function booking(Request $request, Car $car)
    {
        $request->validate([
            'pickup_location' => ['required', 'exists:locations,id'],
            'pickup_time' => ['required', 'date'],
            'return_time' => ['required', 'date'],
            'total_price' => ['required', 'numeric'],
        ]);

        $location = Location::find($request->pickup_location);
        $address = '(' . $location->name . ') ' . $location->address . ', ' . $location->city . ', ' . $location->province . ', ' . $location->country . ', ' . $location->postal_code;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'pickup_time' => $request->pickup_time,
            'return_time' => $request->return_time,
            'pickup_address' => $address,
            'return_address' => $address,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'payment_method' => 'credit_card',
            'payment_number' => Random::generate(16),
            'payment_name' => auth()->user()->name,
            'payment_bank' => 'MasterCard',
            'status' => 'pending',
            'total_payment' => $request->total_price,
        ]);

        return redirect()->route('payment', $payment->id)->with('success', 'Booking success');
    }

    public function paymentSuccess(Payment $payment)
    {
        return view('frontend.payment-success', [
            'payment' => $payment,
        ]);
    }
}
