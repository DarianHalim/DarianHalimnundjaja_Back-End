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
            'namaBarang' => "Barang baru",
            'hargaBarang' => 1200,
            'jumlahBarang' => 10,
            'category_id'=>"1",
        ]);

        Barang::create([
            'namaBarang' => "Barang baru ke 2",
            'hargaBarang' => 1500,
            'jumlahBarang' => 20,
            'category_id'=>"2",
        ]);
    }
}
