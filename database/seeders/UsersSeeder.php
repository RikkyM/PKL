<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Direktur Logistik',
                'username' => 'dirlog',
                'role' => 'direktur logistik',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Admin Logistik',
                'username' => 'admlog',
                'role' => 'admin logistik',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Admin Fakturis',
                'username' => 'adminv',
                'role' => 'admin fakturis',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'budi',
                'username' => 'budi',
                'role' => 'sopir',
                'password' => bcrypt('123123'),
            ],
            // [
            //     'name' => 'budi',
            //     'username' => 'budi',
            //     // 'email' => 'budi@mail.com',
            //     'role' => 'sopir',
            //     'password' => bcrypt('123456'),
            // ],
        ];

        foreach($userData as $key => $val) {
            User::create($val);
        }
    }
}
