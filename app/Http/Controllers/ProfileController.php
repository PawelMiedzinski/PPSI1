<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Public profile page
     */
    public function show(User $user)
    {

        return view(

            'profile',

            compact(

                'user'

            )

        );

    }


    /**
     * Edit own profile
     */
    public function edit(Request $request): View
    {

        return view(

            'profile.edit',

            [

                'user'=>$request->user()

            ]

        );

    }


    /**
     * Update profile
     */
    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse
    {

        $request
            ->user()
            ->fill(

                $request->validated()

            );

        if (

            $request
            ->user()
            ->isDirty('email')

        ) {

            $request
                ->user()
                ->email_verified_at = null;

        }

        $request
            ->user()
            ->save();

        return Redirect

            ::route(

                'profile.edit'

            )

            ->with(

                'status',

                'profile-updated'

            );

    }


    /**
     * Delete account
     */
    public function destroy(
        Request $request
    ): RedirectResponse
    {

        $request
            ->validateWithBag(

                'userDeletion',

                [

                    'password'=>[

                        'required',

                        'current_password'

                    ]

                ]

            );

        $user=$request->user();

        Auth::logout();

        $user->delete();

        $request
            ->session()
            ->invalidate();

        $request
            ->session()
            ->regenerateToken();

        return Redirect::to('/');

    }


    /**
     * User items
     */
    public function userItems(
        User $user
    )
    {

        $items=

            $user
                ->items()
                ->latest()
                ->get();

        return view(

            'profile-items',

            compact(

                'user',

                'items'

            )

        );

    }


    /**
     * User reviews
     */
    public function userReviews(
        User $user
    )
    {

        $reviews=

            $user
                ->reviewsReceived()
                ->latest()
                ->with(

                    'reviewer'

                )
                ->get();

        return view(

            'profile-reviews',

            compact(

                'user',

                'reviews'

            )

        );

    }

}