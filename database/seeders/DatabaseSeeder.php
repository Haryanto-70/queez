<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
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
                'role' => '6CE8BCBA-7030-360A-7C19-8709C47179E6',
                'company' => 'alkemi',
                'active' => true,
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Dashboard Display',
                'email' => 'display@gmail.com',
                'role' => 'C9E11B93-7CEE-3C3F-175E-AC6476CA34E0',
                'company' => 'guest',
                'active' => true,
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Dashboard Dispencer',
                'email' => 'disdi@gmail.com',
                'role' => 'c4c472fe-4a3e-8d7c-326d-2779c0170f38',
                'company' => 'guest',
                'active' => true,
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Dispencer',
                'email' => 'dispen@gmail.com',
                'role' => 'a99e3b4d-54fd-6e51-5a2f-4ed7f06f6582',
                'company' => 'guest',
                'active' => true,
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Customer Service 1',
                'email' => 'cs1@gmail.com',
                'role' => '67B43821-A364-9FDD-2EB2-5F8259936CF5',
                'company' => 'guest',
                'active' => true,
                'password' => bcrypt('bakti123'),


            ],
            [
                'name' => 'Customer Service 2',
                'email' => 'cs2@gmail.com',
                'role' => '8757DEEB-99A7-7C75-8BE1-62D9575D26D5',
                'company' => 'guest',
                'active' => true,
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Customer Admin ',
                'email' => 'spv@gmail.com',
                'role' => '7BFD0B8F-46E5-8E6B-1522-F7DDC2A589DE',
                'company' => 'guest',
                'active' => true,
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Customer Manager',
                'email' => 'mgr@gmail.com',
                'role' => 'C63B8D84-9D6C-8298-43D6-FE67C96E0059',
                'company' => 'guest',
                'active' => true,
                'password' => bcrypt('bakti123'),

            ],
            [
                'name' => 'Guest',
                'email' => 'guest@quenet.com',
                'role' => 'c4c472fe-4a3e-8d7c-326d-2779c0170f38',  // equal to display and dispencer
                'company' => 'trial',
                'active' => true,
                'password' => bcrypt('quenet'),

            ],

        ];

        // 67B43821-A364-9FDD-2EB2-5F8259936CF5
        // C171BC27-679B-478B-64E5-A03A2E7E70EB
        // 8757DEEB-99A7-7C75-8BE1-62D9575D26D5
        // E682C2B5-28AB-1AE0-910A-C4E21A2D7D85
        // 15EA71CF-409C-158B-8D75-6487D1929646
        // 411B69F8-402F-3C3A-7A5C-CE569D8F2857
        // 7BFD0B8F-46E5-8E6B-1522-F7DDC2A589DE
        // C63B8D84-9D6C-8298-43D6-FE67C96E0059
        // 6CE8BCBA-7030-360A-7C19-8709C47179E6
        // C9E11B93-7CEE-3C3F-175E-AC6476CA34E0
        // A99E3B4D-54FD-6E51-5A2F-4ED7F06F6582
        // C4C472FE-4A3E-8D7C-326D-2779C0170F38
        // C28CF263-20A5-32E7-379A-B7561DE267FB			
        // C0498D6B-A42D-3582-1BF4-508E07FE2F1B			
        // 19F7626F-0495-51DD-5005-AA40BD049DE9			




        $roles = [
            [
                'id' => '67B43821-A364-9FDD-2EB2-5F8259936CF5',
                'role' => 'A',
                'name' => 'Customer Service Type A',
                'category' => '1',
                'description' => 'only 1 service type A can handle',

            ],
            [
                'id' => 'C171BC27-679B-478B-64E5-A03A2E7E70EB',
                'role' => 'B',
                'name' => 'Customer Service Type B',
                'category' => '1',
                'description' => 'only 1 service type A can handle',

            ],
            [
                'id' => '8757DEEB-99A7-7C75-8BE1-62D9575D26D5',
                'role' => 'C',
                'name' => 'Customer Service Type C',
                'category' => '1',
                'description' => 'only 1 service type A can handle',

            ],
            [
                'id' => 'E682C2B5-28AB-1AE0-910A-C4E21A2D7D85',
                'role' => 'D',
                'name' => 'Customer Service Type D',
                'category' => '1',
                'description' => 'only 1 service type A can handle',

            ],
            [
                'id' => '15EA71CF-409C-158B-8D75-6487D1929646',
                'role' => 'cs',
                'name' => 'Generic Customer Service',
                'category' => '1',
                'description' => 'only 1 service type ABCD can handle',

            ],
            [
                'id' => '411B69F8-402F-3C3A-7A5C-CE569D8F2857',
                'role' => 'ss',
                'name' => 'Special Service',
                'category' => '1',
                'description' => 'only 1 service type ss can handle',

            ],
            [
                'id' => '7BFD0B8F-46E5-8E6B-1522-F7DDC2A589DE',
                'role' => 'supervisor',
                'name' => 'Approval Role User Management',
                'category' => '1',
                'description' => 'can approve user assignment and performance check for specisif company',

            ],
            [
                'id' => 'C63B8D84-9D6C-8298-43D6-FE67C96E0059',
                'role' => 'manager',
                'name' => 'Manager',
                'category' => '1',
                'description' => 'can check all performance for specific company',

            ],
            [
                'id' => '6CE8BCBA-7030-360A-7C19-8709C47179E6',
                'role' => 'superuser',
                'name' => 'Super User',
                'category' => '2',
                'description' => 'can access all feature in apps and all user ',

            ],
            [
                'id' => 'C9E11B93-7CEE-3C3F-175E-AC6476CA34E0',
                'role' => 'display',
                'name' => 'Dashboard Display',
                'category' => '1',
                'description' => 'only display queue for specific company ',

            ],
            [
                'id' => 'A99E3B4D-54FD-6E51-5A2F-4ED7F06F6582',
                'role' => 'counter',
                'name' => 'Counter Number',
                'category' => '2',
                'description' => 'only display queue for specific company ',

            ],
            [
                'id' => 'C4C472FE-4A3E-8D7C-326D-2779C0170F38',
                'role' => 'display&counter',
                'name' => 'Display & Counter',
                'category' => '1',
                'description' => 'only display queue for specific company ',

            ],
            [
                'id' => 'C28CF263-20A5-32E7-379A-B7561DE267FB',
                'role' => 'guest',
                'name' => 'guest ',
                'category' => '3',
                'description' => 'all feature for desk trial purpose ',

            ],

        ];

        foreach ($users as $user) (
            User::insert($user)
        );

        foreach ($roles as $role) (
            Role::insert($role)
        );
    }
}
