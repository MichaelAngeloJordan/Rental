<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarLocation;
use App\Models\Location;
use Illuminate\Http\Request;

class CarsLocationController extends Controller
{
    public function index()
    {
        return view('cars-location.index', [
            'CarLocations' => CarLocation::all(),
            'cars' => Car::all(),
            'locations' => Location::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('carLocationBag', [
            'location_id' => 'required|exists:locations,id',
            'car_id' => 'required|exists:cars,id',
            'available_from' => 'required|date',
            'available_until' => 'required|date',
        ]);

        if ($request->available_from < now() || $request->available_until < now() || $request->available_from > $request->available_until) {
            return redirect()->route('cars-location')
                ->withErrors(['carLocationBag' => 'Invalid date range.'])
                ->withInput();
        }

        CarLocation::create([
            'location_id' => $request->location_id,
            'car_id' => $request->car_id,
            'available_from' => $request->available_from,
            'available_until' => $request->available_until,
        ]);

        return redirect()->route('cars-location')
            ->with('success', 'Car location created successfully.');
    }

    public function edit(CarLocation $carLocation)
    {
        return view('cars-location.edit', [
            'carLocation' => $carLocation,
            'cars' => Car::all(),
            'locations' => Location::all(),
        ]);
    }

    public function update(Request $request, CarLocation $carLocation)
    {
        $request->validateWithBag('carLocationBag', [
            'location_id' => 'required|exists:locations,id',
            'car_id' => 'required|exists:cars,id',
            'available_from' => 'required|date',
            'available_until' => 'required|date',
        ]);

        if ($request->available_from < now() || $request->available_until < now() || $request->available_from > $request->available_until) {
            return redirect()->route('cars-location')
                ->withErrors(['carLocationBag' => 'Invalid date range.'])
                ->withInput();
        }

        $carLocation->update([
            'location_id' => $request->location_id,
            'car_id' => $request->car_id,
            'available_from' => $request->available_from,
            'available_until' => $request->available_until,
        ]);

        return redirect()->route('cars-location')
            ->with('success', 'Car location updated successfully.');
    }

    public function destroy(CarLocation $carLocation)
    {
        $carLocation->delete();

        return redirect()->route('cars-location');
    }
}
