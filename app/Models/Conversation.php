<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;
use App\Models\Item;

class Conversation extends Model
{

    protected $fillable = [

        'item_id'

    ];


    public function users()
    {

        return $this->belongsToMany(

            User::class

        );

    }


    public function messages()
    {

        return $this->hasMany(

            Message::class

        );

    }


    public function latestMessage()
    {

        return $this->hasOne(

            Message::class

        )

        ->latestOfMany();

    }


    public function item()
    {

        return $this->belongsTo(

            Item::class

        );

    }

}