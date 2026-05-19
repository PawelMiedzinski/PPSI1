<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function updateProfile(Request $request)
    {

        $user = Auth::user();


        if(

            $request->has('name') ||

            $request->has('city') ||

            $request->has('phone') ||

            $request->has('bio')

        ){

            $request->validate([

                'name'=>'required|max:255',

                'city'=>'nullable|max:255',

                'phone'=>'nullable|max:30',

                'bio'=>'nullable|max:1000',

            ]);


            $user->name = $request->name;

            $user->city = $request->city;

            $user->phone = $request->phone;

            $user->bio = $request->bio;

        }



        if($request->hasFile('avatar')){

            $request->validate([

                'avatar'=>'image|max:4096'

            ]);


            if($user->avatar){

                Storage::disk('public')
                    ->delete($user->avatar);

            }

            $user->avatar =

                $request
                ->file('avatar')
                ->store(
                    'avatars',
                    'public'
                );

        }



        if($request->hasFile('banner')){

            $request->validate([

                'banner'=>'image|max:8192'

            ]);


            if($user->banner){

                Storage::disk('public')
                    ->delete($user->banner);

            }

            $user->banner =

                $request
                ->file('banner')
                ->store(
                    'banners',
                    'public'
                );

        }


       $user->save();

        Auth::setUser(
            $user->fresh()
        );

        return back()
        ->with(
            'success',
            'Settings updated successfully.'
        );

    }

}