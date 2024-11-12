<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\PackageTour;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PackageTour::with('category','photos')->get();
        // dd($data);
        return view('tours.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('tours.create', compact('categories','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'categoriesfk' => 'required',
            'citiesfk' => 'required',
            'price' => 'required|string',
            'about' => 'required|string',
            'days' => 'required|string',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,webp',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp',
        ]);

        $data['thumbnail'] = $request->file('thumbnail')->store('uploads', 'public');
        $data['slug'] = Str::slug($request->name);
        $create = PackageTour::create($data);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoName = $photo->store('uploads', 'public');
                $create->photos()->create(['photo' => $photoName]);
            }
        }

        alert()->success('Success', 'Tour created successfully.',);
        return redirect()->route('admin.package_tours.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageTour $packageTour)
    {
        // //show photos latest
        // $photos = $packageTour->photos()->latest()->take('3')->get();

        // return view('tours.show', compact('packageTour', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageTour $packageTour)
    {
        $categories = Category::all();
        $cities = City::all();
        return view('tours.edit', compact('packageTour', 'categories','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageTour $packageTour)
    {
        // dd($request->all());
        // validated
        $data = $request->validate([
            'name' => 'required|string',
            'categoriesfk' => 'required',
            'price' => 'required|string',
            'citiesfk' => 'required',
            'about' => 'required|string',
            'days' => 'required|string',
            'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg,webp,svg',
            'photos.*' => 'sometimes|image|mimes:jpeg,png,jpg,webp,svg',
        ]);
        $data['slug'] = Str::slug($request->name);
        // delete old thumbnail
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($packageTour->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads', 'public');
        }

        // update
        // dd($data);
        $packageTour->update($data);

        // photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoName = $photo->store('uploads', 'public');
                $packageTour->photos()->create(['photo' => $photoName]);
            }
        }
        // redirect
        alert()->success('Success', 'Tour updated successfully.',);
        return redirect()->route('admin.package_tours.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageTour $packageTour)
    {
        // deleted
        $packageTour->delete();
        alert()->success('Success', 'Tour deleted successfully.',);
        return redirect()->route('admin.package_tours.index');

    }
}
