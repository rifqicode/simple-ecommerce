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
            'name' => 'Baju',
            'description' => 'Baju'
        ]);

        Category::create([
            'name' => 'Celana',
            'description' => 'Celana'
        ]);
    }
}
