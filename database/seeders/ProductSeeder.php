<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'INKOMANE Mug',
            'description' => 'High-quality ceramic mug.',
            'price' => 15.00,
            'image' => 'mug.jpg',
        ]);

        Product::create([
            'name' => 'INKOMANE T-shirt',
            'description' => 'Comfortable cotton t-shirt.',
            'price' => 25.00,
            'image' => 'tshirt.jpg',
        ]);

        Product::create([
            'name' => 'INKOMANE Notebook',
            'description' => 'Premium paper notebook for notes and sketches.',
            'price' => 10.00,
            'image' => 'notebook.jpg',
        ]);
    }
}
