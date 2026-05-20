<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [

            'owner_id' => User::inRandomOrder()->first()->id,

            'category_id' => Category::inRandomOrder()->first()->id,

            'title' => fake()->randomElement([

                'Canon EOS R6',
                'PlayStation 5',
                'Nintendo Switch',
                'Witcher 3 PS4',
                'GoPro Hero',
                'DJI Drone',
                'Mountain Bike',
                'Gaming Laptop',
                'Projector',
                'VR Headset'

            ]),

            'description' => fake()->paragraph(),

            'price_per_day' => fake()->numberBetween(
                10,
                300
            ),

            'location' => fake()->city(),

            'status' => fake()->randomElement([

                'available',
                'available',
                'available',
                'rented'

            ]),

            'image' => 'https://picsum.photos/600/400?random='.rand(1,1000),

        ];
    }
}