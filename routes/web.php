<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SettingsController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    return redirect('/dashboard');

});

Route::get('/me', function () {

    return Auth::user();

});

Route::get('/dashboard', function () {

    /** @var \App\Models\User $user */
    $user = Auth::user();

    $itemsCount = $user->items()->count();

    $activeRentals = $user
        ->rentals()
        ->where('status', 'active')
        ->count();

    $returnedRentals = $user
        ->rentals()
        ->where('status', 'returned')
        ->count();

    $cancelledRentals = $user
        ->rentals()
        ->where('status', 'cancelled')
        ->count();

    return view('dashboard', compact(

        'itemsCount',
        'activeRentals',
        'returnedRentals',
        'cancelledRentals'

    ));

})->middleware(['auth', 'verified'])
->name('dashboard');


Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | SETTINGS
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', function () {

        return view('settings');

    })->name('settings');

    Route::post(

        '/settings/profile',

        [SettingsController::class, 'updateProfile']

    )->name('settings.profile');


    /*
    |--------------------------------------------------------------------------
    | ITEMS
    |--------------------------------------------------------------------------
    */

    Route::get('/my-items', function () {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        return $user
            ->items()
            ->with('category')
            ->get();

    });

    Route::resource(
        'items',
        ItemController::class
    );


    /*
    |--------------------------------------------------------------------------
    | RENTALS
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/rentals',
        [RentalController::class, 'store']
    );

    Route::get('/my-rentals', function () {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        return $user
            ->rentals()
            ->where('status', 'active')
            ->with('item')
            ->get();

    });

    Route::patch(

        '/rentals/{rental}/return',

        [RentalController::class, 'returnRental']

    );

    Route::patch(

        '/rentals/{rental}/cancel',

        [RentalController::class, 'cancelRental']

    );

});

require __DIR__.'/auth.php';