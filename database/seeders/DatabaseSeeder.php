<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::updateOrCreate(
            [
                'email' => 'blyakher85@gmail.com',
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('z'),
            ]
        );

        // User::factory()->create([
        //     'name' => 'alex',
        //     'email' => 'blyakher85@gmail.com',
        // ]);

        Tag::factory(20)->create();

        Category::factory(10)->create();

        Product::factory(100)->create();
    }
}
