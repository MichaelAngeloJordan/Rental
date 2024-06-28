<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Role as ModelsRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index()
    {
        return view('drivers.index', [
            'drivers' => Driver::with('user')->get(),
            'locations' => Location::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('driversDeletion', [
            'location_id' => 'required|exists:locations,id',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:15', 'starts_with:62'],
            'gender' => ['required', 'string'],
            'license_number' => ['required', 'string', 'max:20'],
            'status' => ['required', 'string', 'in:active,inactive,pending,suspended,banned'],
            'license_image' => ['required', 'image', 'max:10240'],
            'photo' => ['required', 'image', 'max:10240'],
        ]);

        try {
            $photo = $request->file('photo');
            $photo_path = null;
            if ($photo) {
                $photo_name = 'photo-' . $photo->getClientOriginalName();
                $photo_path = Storage::putFileAs('public/images', $photo, $photo_name);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'password' => bcrypt($request->license_number),
                'photo' => $photo_path,
                'role_id' => ModelsRole::where('slug', Role::Driver)->first()->id,
            ]);

            $licensi_image = $request->file('license_image');
            $licensi_image_path = null;
            if ($licensi_image) {
                $licensi_image_name = 'license-' . $request->license_number . '.' . $licensi_image->getClientOriginalExtension();
                $licensi_image_path = Storage::putFileAs('public/images', $licensi_image, $licensi_image_name);
            }

            $user->driver()->create([
                'user_id' => $user->id,
                'location_id' => $request->location_id,
                'license_number' => $request->license_number,
                'license_image' => $licensi_image_path,
                'status' => $request->status,
            ]);

            return redirect()->route('drivers')
                ->with('success', 'Driver created successfully');
        } catch (\Exception $e) {
            return redirect()->route('drivers')
                ->with('error', 'Failed to create driver');
        }
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', [
            'driver' => $driver,
            'locations' => Location::all(),
        ]);
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validateWithBag('driversDeletion', [
            'location_id' => 'required|exists:locations,id',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class . ',email,' . $driver->user_id],
            'phone' => ['required', 'string', 'max:15', 'starts_with:62'],
            'gender' => ['required', 'string'],
            'license_number' => ['required', 'string', 'max:20'],
            'status' => ['required', 'string', 'in:active,inactive,pending,suspended,banned'],
            'license_image' => ['required', 'image', 'max:10240'],
            'photo' => ['required', 'image', 'max:10240'],
        ]);

        try {
            $photo = $request->file('photo');
            $photo_path = null;
            if ($photo) {
                $photo_name = 'photo-' . $photo->getClientOriginalName();
                $photo_path = Storage::putFileAs('images', $photo, $photo_name);
            }

            $user = User::find($driver->user_id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'photo' => $photo_path,
            ]);

            $licensi_image = $request->file('license_image');
            $licensi_image_path = null;
            if ($licensi_image) {
                $licensi_image_name = 'license-' . $request->license_number . '.' . $licensi_image->getClientOriginalExtension();
                $licensi_image_path = Storage::putFileAs('images', $licensi_image, $licensi_image_name);
            }

            $driver->update([
                'location_id' => $request->location_id,
                'license_number' => $request->license_number,
                'license_image' => $licensi_image_path,
                'status' => $request->status,
            ]);

            return redirect()->route('drivers')
                ->with('success', 'Driver updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('drivers')
                ->with('error', 'Failed to update driver');
        }
    }

    public function destroy(Driver $driver)
    {
        try {
            if ($driver->user->photo) {
                Storage::delete($driver->user->photo);
            }
            if ($driver->license_image) {
                Storage::delete($driver->license_image);
            }
            $driver->user->delete();
            $driver->delete();

            return redirect()->route('drivers');
        } catch (\Exception $e) {
            return redirect()->route('drivers')
                ->with('error', 'Failed to delete driver');
        }
    }
}
