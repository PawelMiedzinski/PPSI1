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


// Dashboard

Route::get(

    '/dashboard',

    function () {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $itemsCount =

            $user
            ->items()
            ->count();

        $activeRentals =

            $user
            ->rentals()
            ->where(
                'status',
                'active'
            )
            ->count();

        $returnedRentals =

            $user
            ->rentals()
            ->where(
                'status',
                'returned'
            )
            ->count();

        $cancelledRentals =

            $user
            ->rentals()
            ->where(
                'status',
                'cancelled'
            )
            ->count();

        return view(

            'dashboard',

            compact(

                'itemsCount',

                'activeRentals',

                'returnedRentals',

                'cancelledRentals'

            )

        );

    }

)

->middleware([

    'auth',

    'verified'

])

->name('dashboard');



Route::middleware('auth')

->group(function () {



// Profile

Route::get(

    '/profile',

    [

        ProfileController::class,

        'edit'

    ]

)

->name('profile.edit');


Route::patch(

    '/profile',

    [

        ProfileController::class,

        'update'

    ]

)

->name('profile.update');


Route::delete(

    '/profile',

    [

        ProfileController::class,

        'destroy'

    ]

)

->name('profile.destroy');



// Settings

Route::get(

    '/settings',

    function(){

        return view(

            'settings'

        );

    }

)

->name('settings');


Route::post(

    '/settings/profile',

    [

        SettingsController::class,

        'updateProfile'

    ]

)

->name('settings.profile');



// Inventory

Route::get(

    '/inventory',

    function(){

        $user = Auth::user();

        $items =

            $user
            ->items()
            ->with(
                'category'
            )
            ->latest()
            ->get();

        return view(

            'inventory',

            compact(
                'items'
            )

        );

    }

)

->name('inventory');



// Rentals

Route::get(

    '/rentals',

    function(){

        $user = Auth::user();

        $activeRentals =

            $user
            ->rentals()
            ->where(

                'status',

                'active'

            )

            ->with(

                'item'

            )

            ->latest()

            ->get();



        $history =

            $user
            ->rentals()

            ->whereIn(

                'status',

                [

                    'returned',

                    'cancelled'

                ]

            )

            ->with(

                'item'

            )

            ->latest()

            ->get();


        return view(

            'rentals',

            compact(

                'activeRentals',

                'history'

            )

        );

    }

)

->name('rentals');



Route::post(

    '/rentals',

    [

        RentalController::class,

        'store'

    ]

);



Route::patch(

    '/rentals/{rental}/return',

    [

        RentalController::class,

        'returnRental'

    ]

);



Route::patch(

    '/rentals/{rental}/cancel',

    [

        RentalController::class,

        'cancelRental'

    ]

);



// Items

Route::resource(

    'items',

    ItemController::class

);



});


require __DIR__.'/auth.php';