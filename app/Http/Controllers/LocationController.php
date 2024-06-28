<?php

namespace App\Http\Controllers;

use App\Class\Datadaerah;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $data = new Datadaerah();

        return view('locations.index', [
            'locations' => Location::all(),
            'provinces' => collect($data->getProvinces()),
        ]);
    }

    public function DataCities($id)
    {
        $data = new Datadaerah();

        return response()->json($data->getCities($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|unique:locations,name|max:255',
            'address' => 'required|max:255',
            'city' => 'required',
            'province' => 'required|max:255',
            'zip_code' => 'required|numeric|digits:5|starts_with:1,2,3,4,5,6,7,8,9,0',
        ]);

        $cekProvince = (new Datadaerah())->searchProvince($request->province);
        if (!$cekProvince) {
            return redirect()->route('location')
                ->with('error', 'Province not found.');
        }
        $cekCity = (new Datadaerah())->searchCity($cekProvince->code, $request->city);

        if (!$cekCity) {
            return redirect()->route('location')
                ->with('error', 'Province or City not found.');
        }

        Location::create([
            'name' => $request->location,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
            'latitude' => $cekCity->coordinates->lat ?: '0',
            'longitude' => $cekCity->coordinates->lng ?: '0',
        ]);

        return redirect()->route('location')
            ->with('success', 'Location has been added.');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', [
            'location' => $location,
            'provinces' => collect((new Datadaerah())->getProvinces()),
        ]);
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'location' => 'required|unique:locations,name|max:255',
            'address' => 'required|max:255',
            'city' => 'required',
            'province' => 'required|max:255',
            'zip_code' => 'required|numeric|digits:5|starts_with:1,2,3,4,5,6,7,8,9,0',
        ]);

        $cekProvince = (new Datadaerah())->searchProvince($request->province);
        if (!$cekProvince) {
            return redirect()->route('location')
                ->with('error', 'Province not found.');
        }

        $cekCity = (new Datadaerah())->searchCity($cekProvince->code, $request->city);
        if (!$cekCity) {
            return redirect()->route('location')
                ->with('error', 'Province or City not found.');
        }

        $location->update([
            'name' => $request->location,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
            'latitude' => $cekCity->coordinates->lat ?: '0',
            'longitude' => $cekCity->coordinates->lng ?: '0',
        ]);

        return redirect()->route('location')
            ->with('success', 'Location has been updated.');
    }

    public function destroy(Location $location)
    {
        $location->cars()->delete();
        $location->delete();

        return redirect()->route('location');
    }
}
