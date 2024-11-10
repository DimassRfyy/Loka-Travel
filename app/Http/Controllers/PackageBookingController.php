<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageBooking;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PackageBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $PackageBookings = PackageBooking::with('customer', 'tour')->get();
        return view('bookings.index', compact('PackageBookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageBooking $PackageBooking)
    {
        return view('bookings.show', compact('PackageBooking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageBooking $PackageBooking)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageBooking $PackageBooking)
    {
        // dd($request->all());
        $request->validate([
            'ispaid' => 'required'
        ]);
        // Store the proof of payment
        $PackageBooking->ispaid = $request->ispaid;
        $PackageBooking->save();
        // alert success
        Alert::success('Success', 'Payment status updated successfully');
        return redirect()->route('admin.package_bookings.show', $PackageBooking);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageBooking $PackageBooking)
    {
        $PackageBooking->delete();
        alert()->success('Success', 'Booking deleted successfully.',);

        if(Auth::user()->hasRole('customer')) {
            return redirect()->route('dashboard.bookings');
        }
        return redirect()->route('admin.package_bookings.index');
    }
}
