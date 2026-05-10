<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        static $categories = [
            'Smartphones',
            'Laptops',
            'Gaming',
            'Audio',
            'Accessories',
            'Cameras',
            'TV',
            'Consoles',
            'Wearables',
            'Tablets',
        ];

        return [
            'name' => fake()->unique()->randomElement($categories),
        ];
    }
}
