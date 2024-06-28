<?php

namespace App\Http\Controllers;

use App\Models\BrandCar;
use App\Models\Car;
use App\Traits\ListTypeCar;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        return view('cars.index', [
            'cars' => Car::all(),
            'brands' => BrandCar::all(),
            'types' => collect(ListTypeCar::listTypeCar()),
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('carsBag', [
            'name' => 'required|string|max:50',
            'brand_id' => 'required|exists:brand_cars,id',
            'type' => 'required|string',
            'color' => 'required|string|max:20',
            'capacity' => 'required|integer',
            'baggages' => 'required|integer',
            'license_plate' => 'required|string|max:15|unique:cars',
            'transmission' => 'required|string|in:Automatic,Manual',
            'year' => 'required|integer',
            'price' => 'required|integer',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'policy' => 'nullable|string',
            'available' => 'required|boolean',
        ]);

        $car = Car::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'type' => $request->type,
            'color' => $request->color,
            'capacity' => $request->capacity,
            'baggages' => $request->baggages,
            'license_plate' => $request->license_plate,
            'transmission' => $request->transmission,
            'year' => $request->year,
            'price' => $request->price,
            'description' => $request->description,
            'features' => $request->features,
            'policy' => $request->policy,
            'available' => $request->available,
        ]);

        if ($request->hasFile('image')) {
            $car->update([
                'image' => $request->file('image')->store('images/cars', 'public'),
            ]);
        }

        return back()->with('success', 'Car added successfully');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', [
            'car' => $car,
            'brands' => BrandCar::all(),
            'types' => collect(ListTypeCar::listTypeCar()),
        ]);
    }

    public function update(Request $request, Car $car)
    {
        $request->validateWithBag('carsBag', [
            'name' => 'required|string|max:50',
            'brand_id' => 'required|exists:brand_cars,id',
            'type' => 'required|string',
            'color' => 'required|string|max:20',
            'capacity' => 'required|integer',
            'baggages' => 'required|integer',
            'license_plate' => 'required|string|max:15|unique:cars,license_plate,' . $car->id,
            'transmission' => 'required|string|in:Automatic,Manual',
            'year' => 'required|integer',
            'price' => 'required|integer',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'policy' => 'nullable|string',
            'available' => 'required|boolean',
        ]);

        $car->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'type' => $request->type,
            'color' => $request->color,
            'capacity' => $request->capacity,
            'baggages' => $request->baggages,
            'license_plate' => $request->license_plate,
            'transmission' => $request->transmission,
            'year' => $request->year,
            'price' => $request->price,
            'description' => $request->description,
            'features' => $request->features,
            'policy' => $request->policy,
            'available' => $request->available,
        ]);

        if ($request->hasFile('image')) {
            unlink(asset('storage/' . $car->image));
            $car->update([
                'image' => $request->file('image')->store('images/cars', 'public'),
            ]);
        }

        return back()->with('success', 'Car updated successfully');
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return back()->with('success', 'Car deleted successfully');
    }
}
