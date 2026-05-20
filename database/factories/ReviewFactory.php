<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [

            'user_id' =>
                User::inRandomOrder()->first()->id,

            'item_id' =>
                Item::inRandomOrder()->first()->id,

            'rating' =>
                fake()->numberBetween(1,5),

            'comment' =>
                fake()->sentence(15),

        ];
    }
}