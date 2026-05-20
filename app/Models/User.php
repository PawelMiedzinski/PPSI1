<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Item;
use App\Models\Rental;
use App\Models\Review;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'banner',
        'bio',
        'city',
        'phone',
        'is_admin',
        'is_banned',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'owner_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'renter_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewsReceived()
    {

    return $this->hasMany(

    Review::class,

    'reviewed_user_id'

    );

    }


    public function reviewsWritten()
    {

    return $this->hasMany(

    Review::class,

    'user_id'

    );

    }


    public function averageRating()
    {

    return round(

    $this

    ->reviewsReceived()

    ->avg(

    'rating'

    )

    ??0,

    1

    );

    }

    public function conversations()
    {
        return $this->belongsToMany(
            Conversation::class
        );
    }


    public function sentMessages()
    {
        return $this->hasMany(
            Message::class,
            'sender_id'
        );
    }
}
