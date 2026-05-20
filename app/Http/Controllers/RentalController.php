<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function create(Item $item)
    {
        return view('rentals.create', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($item->owner_id == Auth::id()) {
            return back()->with('error', 'You cannot rent your own item.');
        }

        if ($item->status === 'rented') {
            return back()->with('error', 'Item is currently unavailable.');
        }

        $overlapping = Rental::where('item_id', $request->item_id)
            ->where('status', 'active')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(fn($q) => $q->where('start_date', '<=', $request->start_date)->where('end_date', '>=', $request->end_date));
            })->exists();

        if ($overlapping) {
            return back()->with('error', 'Item is already rented for selected dates.');
        }

        $days = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;
        $totalPrice = $days * $item->price_per_day;

        Rental::create([
            'item_id' => $item->id,
            'renter_id' => Auth::id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
            'status' => 'active',
        ]);

        $item->update(['status' => 'rented']);

        return redirect()->route('rentals')->with('success', 'Item rented successfully.');
    }

    public function returnRental(Rental $rental)
    {
        if ($rental->renter_id !== Auth::id()) abort(403);

        $rental->update(['status' => 'returned']);
        $rental->item->update(['status' => 'available']);

        return back()->with('success', 'Rental returned.');
    }

    public function cancelRental(Rental $rental)
    {
        if ($rental->renter_id !== Auth::id()) abort(403);
        if ($rental->status !== 'active') return back()->with('error', 'Only active rentals can be cancelled.');

        $rental->update(['status' => 'cancelled']);
        $rental->item->update(['status' => 'available']);

        return back()->with('success', 'Rental cancelled.');
    }
}