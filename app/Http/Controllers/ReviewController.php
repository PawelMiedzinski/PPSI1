<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Rental;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function create(
        Rental $rental
    ){

        if(

            $rental->renter_id
            !==
            Auth::id()

        ){

            abort(403);

        }


        if(

            $rental->status
            !==
            'returned'

        ){

            return back()

            ->with(

                'error',

                'Rental must be completed.'

            );

        }


        $existing =

        Review::where(

            'rental_id',

            $rental->id

        )

        ->exists();


        if(

            $existing

        ){

            return back()

            ->with(

                'error',

                'Review already exists.'

            );

        }


        return view(

            'reviews.create',

            compact(

                'rental'

            )

        );

    }


    public function store(
        Request $request
    ){

        $validated =

        $request->validate([

            'rental_id'=>

            'required|exists:rentals,id',

            'rating'=>

            'required|integer|min:1|max:5',

            'comment'=>

            'required|string|min:5|max:1000',

        ]);


        $rental =

        Rental::with(

            'item'

        )

        ->findOrFail(

            $validated['rental_id']

        );


        Review::create([

            'user_id'=>

            Auth::id(),

            'reviewed_user_id'=>

            $rental->item->owner_id,

            'item_id'=>

            $rental->item_id,

            'rental_id'=>

            $rental->id,

            'rating'=>

            $validated['rating'],

            'comment'=>

            $validated['comment'],

        ]);


        return redirect()

        ->route(

            'rentals'

        )

        ->with(

            'success',

            'Review submitted.'

        );

    }

}