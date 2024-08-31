<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([

            'name'=>"Makanan",
        ]);

        Category::create([

            'name'=>"Minuman",
        ]);

        Category::create([
            
            'name'=>"Snack",
        ]);


        Category::create([
            
            'name'=>"Desert",
        ]);
    }
}
