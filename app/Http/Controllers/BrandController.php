<?php

namespace App\Http\Controllers;

use App\Models\BrandCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        return view('brands.index', [
            'brands' => BrandCar::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('brandBag', [
            'name' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'country' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->extension();
            $path = Storage::putFileAs('images', $logo, $logoName);
        }

        BrandCar::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo' => $path,
            'country' => $request->country,
            'description' => $request->description,
        ]);

        return redirect()->route('brands')
            ->with('success', 'Brand created successfully.');
    }

    public function edit(BrandCar $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, BrandCar $brand)
    {
        $request->validateWithBag('brandBag', [
            'name' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'country' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->extension();
            $logo_path = Storage::putFileAs('images', $logo, $logoName);
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo' => $logo_path ?? $brand->logo,
            'country' => $request->country,
            'description' => $request->description,
        ]);

        return redirect()->route('brands')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(BrandCar $brand)
    {
        if ($brand->logo) {
            unlink(public_path('images/' . $brand->logo));
        }
        $brand->delete();

        return redirect()->route('brands');
    }
}
