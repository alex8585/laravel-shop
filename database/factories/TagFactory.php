<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        static $tags = [
            'New',
            'Popular',
            'Sale',
            'Premium',
            'Gaming',
            'Wireless',
            'Bluetooth',
            'Apple',
            'Samsung',
            '4K',
            'Portable',
            'Professional',
        ];

        return [
            'name' => fake()->randomElement($tags),
        ];
    }
}

