<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Rental;
use App\Models\Item;

class Review extends Model
{

    protected $fillable = [

        'user_id',

        'reviewed_user_id',

        'item_id',

        'rental_id',

        'rating',

        'comment',

    ];


    public function reviewer()
    {

        return $this->belongsTo(

            User::class,

            'user_id'

        );

    }


    public function reviewedUser()
    {

        return $this->belongsTo(

            User::class,

            'reviewed_user_id'

        );

    }


    public function rental()
    {

        return $this->belongsTo(

            Rental::class

        );

    }


    public function item()
    {

        return $this->belongsTo(

            Item::class

        );

    }

}