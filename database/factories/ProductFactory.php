<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'name' => $name,

            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 9999)),

            'description' => fake()->paragraph(),

            'price' => fake()->randomFloat(2, 10, 500),

            'stock' => fake()->numberBetween(0, 100),

            'is_active' => fake()->boolean(90),

            'category_id' => Category::factory(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function ($product) {

            $tags = Tag::inRandomOrder()
                ->limit(rand(1, 5))
                ->pluck('id');

            $product->tags()->attach($tags);

        });
    }
}
