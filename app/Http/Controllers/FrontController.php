<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use App\Models\PackageBank;
use App\Models\PackageTour;
use Illuminate\Http\Request;
use App\Models\PackageBooking;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\RecommendationService;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(RecommendationService $recommender)
    {
        $categories = Category::orderByDesc('id')->paginate(10);
        $cities = City::orderByDesc('id')->paginate(10);
        $tours = PackageTour::orderByDesc('id')->paginate(5);

        $recommendedTours = Auth::check() 
            ? $recommender->getRecommendationsForUser(Auth::user())
            : collect();

        return view('frontend.index', compact('categories', 'tours', 'cities', 'recommendedTours'));
    }

    public function categories(Category $category)
    {
        $packageTours = PackageTour::where('categoriesfk', $category->id)
                        ->orderByDesc('id')
                        ->paginate(10);
    
        return view('frontend.categories', compact('category', 'packageTours'));
    }    
    public function cities(City $city)
    {
        $packageTours = PackageTour::where('citiesfk', $city->id)
                        ->orderByDesc('id')
                        ->paginate(10);
    
        return view('frontend.cities', compact('city', 'packageTours'));
    }    


    public function details(PackageTour $packageTour)
    {
        return view('frontend.details', compact('packageTour'));
    }

    public function booking(PackageTour $packageTour)
    {
        // dd($packageTour->price);
        return view('frontend.book', compact('packageTour'));
    }
    public function book_store(Request $request, PackageTour $packageTour)
    {
        $data = $request->validate([
            'startdate' => 'required|date',
            'quantity' => 'required|numeric',
            'totalamount' => 'required|numeric',
        ]);

        $bank = PackageBank::first();
        $startDate = new Carbon($request->startdate);
        
        $data['packagetoursfk'] = $packageTour->id;
        $data['usersfk'] = Auth::user()->id;
        $data['packagebanksfk'] = $bank->id;
        $data['proof'] = 0;
        $data['ispaid'] = 0;
        $data['insurance'] = 200000 * $data['quantity'];
        $data['tax'] = $packageTour->price * 0.1 * $data['quantity'];
        $data['subtotal'] = $packageTour->price * $data['quantity'];
        $data['totalamount'] = $data['subtotal'] + $data['tax'] + $data['insurance'];
        $data['startdate'] = $startDate;
        $data['enddate'] = $startDate->copy()->addDays($packageTour->days); // Gunakan copy()

        $packageBooking = PackageBooking::create($data);
        return redirect()->route('choose.bank', $packageBooking->id);
    }
    public function choose_bank(PackageBooking $packageBooking)
    {
        if($packageBooking->usersfk != Auth::user()->id){
            Alert::error('Error', 'You are not authorized to access this page');
            abbort(403, 'You are not authorized to access this page');
        }
        $banks = PackageBank::all();
        return view('frontend.choosebank', compact('banks', 'packageBooking'));

    }

    public function choose_bank_store(Request $request, PackageBooking $packageBooking)
    {
        $data = $request->validate([
            'bankname' => 'required',
        ]);
        $packageBooking->update([
            'packagebanksfk' => $data['bankname'],
        ]);
        // dd($packageBooking);
        return redirect()->route('book.payment', $packageBooking->id);
    }
    public function book_payment(PackageBooking $packageBooking)
    {
        if($packageBooking->usersfk != Auth::user()->id){
            Alert::error('Error', 'You are not authorized to access this page');
            abbort(403, 'You are not authorized to access this page');
        }
        return view('frontend.payment', compact('packageBooking'));
    }
    public function book_payment_store(Request $request, PackageBooking $packageBooking)
    {
        $data = $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data['proof'] = $request->file('proof')->store('assets/proof', 'public');

        $packageBooking->update([
            'proof' => $data['proof'],
            'ispaid' => 1,
        ]);

        // Tambahkan rating default 5
        $userId = auth()->id();
        $packageTour = $packageBooking->tour; // pastikan relasinya ada

        if ($packageTour) {
            DB::table('package_tour_user')->updateOrInsert(
                ['user_id' => $userId, 'package_tour_id' => $packageTour->id],
                ['rating' => 5, 'updated_at' => now(), 'created_at' => now()]
            );
        }

        return redirect()->route('book.finish');
    }

    public function book_finish()
    {
        return view('frontend.finish');
    }
    public function my_bookings()
    {
        $bookings = PackageBooking::where('usersfk', Auth::user()->id)->orderByDesc('id')->paginate('10');
        return view('frontend.schedule', compact('bookings'));
    }
    public function my_bookings_details(PackageBooking $packagebooking)
    {
        if($packagebooking->usersfk != Auth::user()->id){
            Alert::error('Error', 'You are not authorized to access this page');
            abbort(403, 'You are not authorized to access this page');
        }
        return view('frontend.schedule_details', compact('packagebooking'));
    }

    public function phonenumber_user_socialite(Request $request, User $user) {
        $phone = $request->validate([
            'phonenumber' => 'required|tel',
        ]);

        $user->update($phone);
        return redirect()->route('home');
    }

    public function search() {
        $cities = City::all();
        $categories = Category::all();
        return view('frontend.search', compact('cities', 'categories'));
    }

    public function search_result(Request $request)
    {
        $packageTours = PackageTour::query();

        if ($request->filled('category')) {
            $packageTours->where('categoriesfk', $request->category);
        }

        if ($request->filled('city')) {
            $packageTours->where('citiesfk', $request->city);
        }

        if ($request->filled('name')) {
            $packageTours->where('name', 'like', '%' . $request->name . '%');
        }

        $packageTours = $packageTours->paginate(20);

        $categories = Category::all();
        $cities = City::all();

        return view('frontend.search_result', compact('packageTours', 'categories', 'cities'));
    }
}
