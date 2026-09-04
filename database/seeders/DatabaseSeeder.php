<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin_3988'),
        ]);

        User::factory()->create([
            'name' => 'Nguyễn Công Lập',
            'username' => 'lapnc',
            'email' => 'lapnc@gmail.com',
            'password' => bcrypt('admin_lap_@'),
        ]);
    }
}