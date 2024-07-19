<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            [
                'name' => 'Haryanto',
                'email' => 'hary7072@gmail.com',
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Technician User',
                'email' => 'tech@gmail.com',
                'password' => bcrypt('bakti123'),


            ],
            [
                'name' => 'Admin User 2',
                'email' => 'admin2@gmail.com',
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Technician User 2',
                'email' => 'tech2@gmail.com',
                'password' => bcrypt('bakti123'),

            ],

        ];
        foreach ($users as $user) (
            User::insert($user)
        );
    }
}
