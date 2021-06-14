<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Makanan',
            'description' => 'makanan'
        ]);

        Category::create([
            'name' => 'Minuman',
            'description' => 'minuman'
        ]);
    }
}
