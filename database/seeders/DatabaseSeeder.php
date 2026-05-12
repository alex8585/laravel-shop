<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            [
                'email' => 'blyakher85@gmail.com',
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('z'),
            ]
        );

        // TAGS
        $tags = [
            'New',
            'Popular',
            'Sale',
            'Gaming',
            'Portable',
            'Wireless',
            'Bluetooth',
            'Premium',
            'Budget',
            'Professional',
            '4K',
            'Smart',
            'RGB',
            'Noise Cancelling',
            'USB-C',
            'Fast Charging',
            'OLED',
            'Waterproof',
            'Compact',
            'Limited Edition',
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate([
                'name' => $tag,
            ]);
        }

        // CATEGORIES
        $categories = [
            'Smartphones',
            'Laptops',
            'Tablets',
            'Audio',
            'Gaming',
            'Cameras',
            'Accessories',
            'Monitors',
            'Smart Home',
            'Wearables',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'name' => $category,
            ]);
        }
        $this->call(ProductImportSeeder::class);
        // PRODUCTS
        // Product::factory(100)->create();
    }
}
