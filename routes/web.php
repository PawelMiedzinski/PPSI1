<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    return redirect('/dashboard');

});

Route::get('/me', function () {

    return Auth::user();

});



// DASHBOARD

Route::get(

'/dashboard',

function(){

$user=Auth::user();

$itemsCount=

$user
->items()
->count();

$activeRentals=

$user
->rentals()
->where(
'status',
'active'
)
->count();

$returnedRentals=

$user
->rentals()
->where(
'status',
'returned'
)
->count();

$cancelledRentals=

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

})

->middleware([

'auth',
'verified',
'ban'

])

->name('dashboard');



Route::middleware([

'auth',
'ban'

])

->group(function(){



// PROFILE

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


Route::get(

'/users/{user}',

[

ProfileController::class,
'show'

]

)

->name('profile.show');


Route::get(

'/inventory/{user}',

[

ProfileController::class,
'userItems'

]

)

->name('profile.items');


Route::get(

'/users/{user}/reviews',

[

ProfileController::class,
'userReviews'

]

)

->name('profile.reviews');



// SETTINGS

Route::get(

'/settings',

function(){

return view(

'settings'

);

})

->name('settings');


Route::post(

'/settings/profile',

[

SettingsController::class,
'updateProfile'

]

)

->name('settings.profile');



// INVENTORY

Route::get(

'/inventory',

function(){

$user=Auth::user();

$items=

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

})

->name('inventory');



// RENTALS

Route::get(

'/rentals',

function(){

$user=Auth::user();

$activeRentals=

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


$history=

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

})

->name('rentals');


Route::post(

'/rentals',

[

RentalController::class,
'store'

]

)

->name(

'rentals.store'

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


Route::get(

'/rent/{item}',

[

RentalController::class,
'create'

]

)

->name(

'rentals.create'

);



// REVIEWS

Route::get(

'/reviews/{rental}',

[

ReviewController::class,
'create'

]

)

->name(

'reviews.create'

);


Route::post(

'/reviews',

[

ReviewController::class,
'store'

]

)

->name(

'reviews.store'

);



// ITEMS

Route::resource(

'items',

ItemController::class

);


Route::delete(

'/items/{item}',

[

ItemController::class,
'destroy'

]

)

->name(

'items.destroy'

);



// MESSAGES

Route::get(

'/messages',

[

MessageController::class,
'index'

]

);

Route::get(

'/messages/start/{user}',

[

MessageController::class,
'start'

]

);

Route::get(

'/messages/{conversation}',

[

MessageController::class,
'show'

]

);

Route::post(

'/messages/{conversation}',

[

MessageController::class,
'store'

]

);

});



// ADMIN

Route::middleware([

'auth',
'ban',
'admin'

])

->prefix('admin')

->group(function(){


Route::get(

'/',

[

AdminController::class,
'index'

]

)

->name(

'admin.dashboard'

);


Route::get(

'/users',

[

AdminController::class,
'users'

]

)

->name(

'admin.users'

);


Route::patch(

'/users/{user}/ban',

[

AdminController::class,
'toggleBan'

]

)

->name(

'admin.users.ban'

);


Route::get(

'/items',

[

AdminController::class,
'items'

]

)

->name(

'admin.items'

);


Route::delete(

'/items/{item}',

[

AdminController::class,
'destroyItem'

]

)

->name(

'admin.items.destroy'

);

});


require __DIR__.'/auth.php';