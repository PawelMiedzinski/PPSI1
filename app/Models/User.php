<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Item;
use App\Models\Rental;
use App\Models\Review;
use App\Models\Conversation;
use App\Models\Message;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'banner', 'bio', 'city', 'phone', 'is_admin', 'is_banned',
    ];

    protected $hidden = ['password', 'remember_token'];

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
        return $this->hasMany(Review::class, 'reviewed_user_id');
    }

    public function reviewsWritten()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function averageRating()
    {
        return round($this->reviewsReceived()->avg('rating') ?? 0, 1);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}