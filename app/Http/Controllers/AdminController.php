<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Rental;

class AdminController extends Controller
{

    public function index()
    {

        return view(

            'admin.dashboard',

            [

                'usersCount' => User::count(),

                'itemsCount' => Item::count(),

                'rentalsCount' => Rental::count(),

                'bannedUsers' => User::where(

                    'is_banned',

                    true

                )->count()

            ]

        );

    }



    public function users()
    {

        $users=

        User::latest()

        ->paginate(20);

        return view(

            'admin.users',

            compact(

                'users'

            )

        );

    }



    public function toggleBan(User $user)
    {

        if(

            $user->id===auth()->id()

        ){

            return back()

            ->with(

                'error',

                'Nie możesz zbanować samego siebie.'

            );

        }



        $user->update(

            [

                'is_banned'=>

                !$user->is_banned

            ]

        );



        return back()

        ->with(

            'success',

            $user->is_banned

            ?

            'Użytkownik zbanowany.'

            :

            'Ban zdjęty.'

        );

    }



    public function items()
    {

        $items=

        Item::with(

            'owner'

        )

        ->latest()

        ->paginate(20);



        return view(

            'admin.items',

            compact(

                'items'

            )

        );

    }



    public function destroyItem(Item $item)
    {

        if(

            $item->image

            &&

            \Storage::disk(

                'public'

            )

            ->exists(

                $item->image

            )

        ){

            \Storage::disk(

                'public'

            )

            ->delete(

                $item->image

            );

        }



        $item->delete();



        return back()

        ->with(

            'success',

            'Ogłoszenie usunięte.'

        );

    }

}