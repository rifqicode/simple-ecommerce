<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'category_id' => 1,
            'name' => 'Baju Baru',
            'description' => 'Baju',
            'image' => 'assets/dummy/test.jpg',
            'stock' => 50,
            'active' => 1,
            'price' => 150000
        ]);

        Item::create([
            'category_id' => 2,
            'name' => 'Celana Baru',
            'description' => 'Celana',
            'image' => 'assets/dummy/test.jpg',
            'stock' => 50,
            'active' => 1,
            'price' => 150000
        ]);
    }
}
