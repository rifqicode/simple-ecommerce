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
            'name' => 'Nasi Goreng',
            'description' => 'Nasi yang tergoreng',
            'image' => 'assets/dummy/test.jpg',
            'stock' => 20,
            'active' => 1,
            'price' => 25000
        ]);

        Item::create([
            'category_id' => 2,
            'name' => 'Jus Alpukat',
            'description' => 'Alpukat yang diproses menjadi minuman',
            'image' => 'assets/dummy/test.jpg',
            'stock' => 50,
            'active' => 1,
            'price' => 15000
        ]);
    }
}
