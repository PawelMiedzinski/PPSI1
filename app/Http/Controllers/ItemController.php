<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ItemController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware(

                'auth',

                except: [

                    'index',

                    'show'

                ]

            )

        ];
    }

    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Item::with([

            'owner',

            'category'

        ]);

        if($request->filled('search')){

            $query->where(

                function($q) use($request){

                    $q->where(

                        'title',

                        'like',

                        '%'.$request->search.'%'

                    )

                    ->orWhere(

                        'description',

                        'like',

                        '%'.$request->search.'%'

                    );

                }

            );

        }

        if($request->filled('category_id')){

            $query->where(

                'category_id',

                $request->category_id

            );

        }

        if($request->filled('location')){

            $query->where(

                'location',

                'like',

                '%'.$request->location.'%'

            );

        }

        if($request->filled('status')){

            $query->where(

                'status',

                $request->status

            );

        }

        if($request->filled('min_price')){

            $query->where(

                'price_per_day',

                '>=',

                $request->min_price

            );

        }

        if($request->filled('max_price')){

            $query->where(

                'price_per_day',

                '<=',

                $request->max_price

            );

        }

        switch($request->sort){

            case 'price_low':

                $query->orderBy(

                    'price_per_day'

                );

                break;

            case 'price_high':

                $query->orderBy(

                    'price_per_day',

                    'desc'

                );

                break;

            case 'oldest':

                $query->oldest();

                break;

            default:

                $query->latest();

        }

        $items =

            $query

            ->paginate(12)

            ->withQueryString();

        return view(

            'items.index',

            compact(

                'items',

                'categories'

            )

        );
    }

    public function create()
    {
        $categories = Category::all();

        return view(

            'items.create',

            compact(

                'categories'

            )

        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => 'required|string|max:255',

            'description' => 'required|string',

            'price_per_day' => 'required|numeric|min:0|max:999999.99',

            'location' => 'required|string|max:255',

            'category_id' => 'required|exists:categories,id',

            'image' => 'nullable|image|max:8192'

        ]);

        if($request->hasFile('image')){

            $validated['image'] =

                $request
                ->file('image')
                ->store(
                    'items',
                    'public'
                );

        }

        $validated['owner_id'] = Auth::id();

        $validated['status'] = 'available';

        Item::create($validated);

        return redirect()

            ->route('items.index')

            ->with(

                'success',

                'Item added.'

            );
    }

    public function show(Item $item)
    {
        $item->load([

            'owner',

            'category'

        ]);

        return view(

            'items.show',

            compact(

                'item'

            )

        );
    }

    public function edit(Item $item)
    {
        if(

            $item->owner_id !== Auth::id()

        ){

            abort(

                403,

                'Brak uprawnień.'

            );

        }

        $categories = Category::all();

        return view(

            'items.edit',

            compact(

                'item',

                'categories'

            )

        );
    }

    public function update(Request $request, Item $item)
    {
        if(

            $item->owner_id !== Auth::id()

        ){

            abort(

                403,

                'Unauthorized access.'

            );

        }

        $validated = $request->validate([

            'title'=>'required|string|max:255',

            'description'=>'required|string',

            'price_per_day'=>'required|numeric|min:0',

            'location'=>'required|string|max:255',

            'category_id'=>'required|exists:categories,id',

            'status'=>'required|in:available,rented',

            'image'=>'nullable|image|max:8192'

        ]);

        if($request->hasFile('image')){

            if(

                $item->image
                &&

                !str_contains(

                    $item->image,

                    'picsum.photos'

                )

            ){

                Storage::disk(

                    'public'

                )->delete(

                    $item->image

                );

            }

            $validated['image'] =

                $request
                ->file('image')
                ->store(
                    'items',
                    'public'
                );

        }

        $item->update(

            $validated

        );

        return redirect()

            ->route(

                'items.show',

                $item

            )

            ->with(

                'success',

                'Item updated.'

            );
    }

    public function destroy(Item $item)
    {
        if(

            $item->owner_id !== Auth::id()

        ){

            abort(

                403,

                'No access.'

            );

        }

        if(

            $item->image
            &&

            !str_contains(

                $item->image,

                'picsum.photos'

            )

        ){

            Storage::disk(

                'public'

            )->delete(

                $item->image

            );

        }

        $item->delete();

        return redirect()

            ->route(

                'inventory'

            )

            ->with(

                'success',

                'Item deleted.'

            );
    }
}