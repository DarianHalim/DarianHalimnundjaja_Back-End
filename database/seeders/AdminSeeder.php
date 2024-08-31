<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1'),
            'noHp' => '081113803882',
            'role' => 'admin',
        ]);

    }
}
