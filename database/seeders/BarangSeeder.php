<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'title'=> "judul baru",
            'author'=>  "penagrang baru",
            'price'=> 1200,
            'release'=> "2024-08-01",
            'category_id'=>"1",
        ]);

        Barang::create([
            'title'=> "judul baru ke 2",
            'author'=>  "penagrang baru",
            'price'=> 1200,
            'release'=> "2024-08-01",
            'category_id'=>"2",
        ]);
    }
}
