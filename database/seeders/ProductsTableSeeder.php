<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Pet Cage',
                'description' => 'A secure and durable enclosure to keep your pet safe and comfortable.',
                'price' => 3999.00,
                'image_path' => 'img/petcage.png',
                'category' => 'Enclosures',
                'stock_quantity' => 10,
                'is_active' => 1,
            ],
            [
                'name' => 'Rubber Toy',
                'description' => 'A chewable, flexible toy designed to keep pets entertained and reduce boredom.',
                'price' => 150.00,
                'image_path' => 'img/rubber-toy.png',
                'category' => 'Toys',
                'stock_quantity' => 50,
                'is_active' => 1,
            ],
            // Add the rest of your products in the same format
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }

        $this->command->info(count($products) . " products added/updated successfully!");
    }
}
