<?php

namespace App\Http\Controllers;

use pagination;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate('10');
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:png,jpg,jpeg,webp',
        ]);
        // Upload image
        $data['icon'] = $request->file('icon')->store('icons','public');
        $data['slug'] = Str::slug($request->name);

        Category::create($data);
        alert()->success('Success', 'Category created successfully.',);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = Category::find($category->id);
        return view('categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'sometimes|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if($request->hasFile('icon')){
            // Delete old image
            Storage::disk('public')->delete($category->icon);
            // Upload new image
            $data['icon'] = $request->file('icon')->store('icons','public');
        }

        $data['slug'] = Str::slug($request->name);

        $category->update($data);
        alert()->success('Success', 'Category edited successfully.',);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // konfirmasi delete

        // Delete image
        Storage::disk('public')->delete($category->icon);

        $category->delete();
        alert()->success('Success', 'Category deleted successfully.',);
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
