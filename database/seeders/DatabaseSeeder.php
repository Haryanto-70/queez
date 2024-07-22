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
                'role' => 'admin',
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Dashboard Display',
                'email' => 'admin@gmail.com',
                'role' => 'dsiplay',
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Customer Service 1',
                'email' => 'cs1@gmail.com',
                'role' => 'cs',
                'password' => bcrypt('bakti123'),


            ],
            [
                'name' => 'Customer Service 2',
                'email' => 'cs2@gmail.com',
                'role' => 'cs',
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Customer Admin 1',
                'email' => 'ca1@gmail.com',
                'role' => 'ca',
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Customer Admin 2',
                'email' => 'ca2@gmail.com',
                'role' => 'ca',
                'password' => bcrypt('bakti123'),

            ],

        ];
        foreach ($users as $user) (
            User::insert($user)
        );
    }
}
