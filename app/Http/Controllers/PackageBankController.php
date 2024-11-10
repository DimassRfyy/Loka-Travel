<?php

namespace App\Http\Controllers;

use App\Models\packageBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = packageBank::all();
        return view('banks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'bankname' => 'required|string',
            'bankaccountnumber' => 'required|numeric',
            'bankaccountname' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);
        // store image
        $data['logo'] = $request->file('logo')->store('logo','public');
        packageBank::create($data);
        alert()->success('Success', 'Bank created successfully.');
        return redirect()->route('admin.package_banks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(packageBank $packageBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(packageBank $packageBank)
    {
        $data = packageBank::find($packageBank->id);
        return view('banks.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, packageBank $packageBank)
    {
        $data = $request->validate([
            'bankname' => 'required|string',
            'bankaccountnumber' => 'required|numeric',
            'bankaccountname' => 'required|string',
            'logo' => 'image|mimes:jpeg,png,jpg,svg',
        ]);
        if($request->hasFile('logo')){
            // delete old image
            Storage::delete('public/'.$packageBank->logo);
            // store image
            $data['logo'] = $request->file('logo')->store('logo','public');
        }
        packageBank::where('id', $packageBank->id)->update($data);
        alert()->success('Success', 'Bank updated successfully.');
        return redirect()->route('admin.package_banks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(packageBank $packageBank)
    {
        // delete image
        Storage::delete('public/'.$packageBank->logo);
        packageBank::destroy($packageBank->id);
        alert()->success('Success', 'Bank deleted successfully.');
        return redirect()->route('admin.package_banks.index');
    }
}
