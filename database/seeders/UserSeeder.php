<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),

            ],
            [
                'name' => 'Pembeli Demo',
                'email' => 'customer@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'customer', // Tambahkan juga untuk contoh user biasa
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
