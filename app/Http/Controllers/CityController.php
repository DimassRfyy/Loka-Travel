<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::orderByDesc('id')->paginate('10');
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp,svg',
        ]);
        // Upload image
        $data['image'] = $request->file('image')->store('images','public');
        $data['slug'] = Str::slug($request->name);

        City::create($data);
        alert()->success('Success', 'City created successfully.',);
        return redirect()->route('admin.cities.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $data = City::find($city->id);
        return view('cities.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:png,jpg,jpeg,webp,svg',
        ]);

        if($request->hasFile('image')){
            // Delete old image
            Storage::disk('public')->delete($city->image);
            // Upload new image
            $data['image'] = $request->file('image')->store('images','public');
        }

        $data['slug'] = Str::slug($request->name);

        $city->update($data);
        alert()->success('Success', 'City edited successfully.',);
        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
         // konfirmasi delete

        // Delete image
        Storage::disk('public')->delete($city->image);

        $city->delete();
        alert()->success('Success', 'City deleted successfully.',);
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
    }
}
