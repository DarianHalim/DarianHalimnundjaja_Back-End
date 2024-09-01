<?php

namespace Database\Seeders;

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
            'namaBarang' => 'Ayam Goreng',
            'hargaBarang' => 15000,
            'jumlahBarang' => 0,
            'category_id' => 3,
            'image' => 'Ayam Goreng_1725185380.png'
        ]);

        Barang::create([
            'namaBarang' => 'Bread',
            'hargaBarang' => 10000,
            'jumlahBarang' => 25,
            'category_id' => 1,
            'image' => 'Bread_1725099338.jpg'
        ]);

        Barang::create([
            'namaBarang' => 'Cendol',
            'hargaBarang' => 16000,
            'jumlahBarang' => 14,
            'category_id' => 4,
            'image' => 'Cendol_1725185410.jpg'
        ]);

        Barang::create([
            'namaBarang' => 'Es Teh Manis',
            'hargaBarang' => 7000,
            'jumlahBarang' => 21,
            'category_id' => 2,
            'image' => 'Es Teh Manis_1725185507.jpg'
        ]);

        Barang::create([
            'namaBarang' => 'Es Teh Tawar',
            'hargaBarang' => 5000,
            'jumlahBarang' => 17,
            'category_id' => 2,
            'image' => 'Es Teh Tawar_1725185454.jpg'
        ]);

        Barang::create([
            'namaBarang' => 'Burger',
            'hargaBarang' => 25000,
            'jumlahBarang' => 8,
            'category_id' => 1,
            'image' => 'Burger_1725185234.jpeg'
        ]);
    }
}
