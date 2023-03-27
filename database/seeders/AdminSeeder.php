<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Abdelrahman Hamdy',
            'email' => 'admin@gmail.com',
            'password'=> '$2y$10$ko8p8.Y4XsGQCoNoRmX7ruc27tRj3KVYLDcl9zcrAVFouC8cVVUiK', //123456789
        ]);
    }
}
