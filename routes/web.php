<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PackageBankController;
use App\Http\Controllers\PackageTourController;
use App\Http\Controllers\PackageBookingController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/categories/{category:slug}', [FrontController::class, 'categories'])->name('categories');
Route::get('/cities/{city:slug}', [FrontController::class, 'cities'])->name('cities');
Route::get('/details/{packageTour:slug}', [FrontController::class, 'details'])->name('details');
Route::get('/search', [FrontController::class, 'search'])->name('search');
Route::get('/auth/{provider}/redirect',[SocialiteController::class,'redirect'])->name('socialiteRedirect');
Route::get('/auth/{provider}/callback',[SocialiteController::class,'callback'])->name('socialiteCallback');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:checkout package')->group(function(){
    Route::get('/booking/{packageTour:slug}', [FrontController::class, 'booking'])->name('booking');
    Route::get('book/{packageTour:slug}', [FrontController::class, 'book'])->name('book');
    Route::post('book/{packageTour:slug}', [FrontController::class, 'book_store'])->name('book.store');

    Route::get('book/choose-bank/{packageBooking}/', [FrontController::class, 'choose_bank'])->name('choose.bank');
    Route::patch('book/choose-bank/{packageBooking}/save', [FrontController::class, 'choose_bank_store'])->name('choose.bank.store');

    Route::get('book/payment/{packageBooking}/save', [FrontController::class, 'book_payment'])->name('book.payment');
    Route::patch('book/payment/{packageBooking}/save', [FrontController::class, 'book_payment_store'])->name('book.payment.store');

    Route::get('book-finish', [FrontController::class, 'book_finish'])->name('book.finish');
    });
    Route::prefix('dashboard')->name('dashboard.')->group(function(){
        Route::middleware('can:view orders')->group(function(){
            Route::get('my-orders', [FrontController::class, 'my_bookings'])->name('bookings');
            Route::get('my-orders/details/{packagebooking}', [FrontController::class, 'my_bookings_details'])->name('booking.details');
        });
    });


    Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware('can:manage categories')->group(function(){
            Route::resource('categories', CategoryController::class);
            Route::resource('cities', CityController::class);
        });

        Route::middleware('can:manage packages')->group(function(){
            Route::resource('package_tours', PackageTourController::class);
        });

        Route::middleware('can:manage package banks')->group(function(){
            Route::resource('package_banks', PackageBankController::class);
        });

        Route::middleware('can:checkout package')->group(function(){
            Route::resource('package_bookings', PackageBookingController::class);
        });
    });
});

require __DIR__.'/auth.php';
