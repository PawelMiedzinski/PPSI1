<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Item;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(

            CategorySeeder::class

        );

        User::factory(30)->create();

        Item::factory(100)->create();

        Review::factory(150)->create();
    }
}