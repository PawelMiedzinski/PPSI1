<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Item;
use App\Models\User;
use App\Models\Review;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'renter_id', 'start_date', 'end_date', 'total_price', 'status'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}