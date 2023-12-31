<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Deo',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin'),
                'role' => 'admin'
            ],
            [
                'name' => 'Andrianto',
                'email' => 'dokter@mail.com',
                'password' => bcrypt('dokter'),
                'role' => 'dokter'
            ],
            [
                'name' => 'Iskandar',
                'email' => 'pasien@mail.com',
                'password' => bcrypt('pasien'),
                'role' => 'pasien'
            ]
        ];

        foreach ($users as $key => $val) {
            User::create($val);
        }
    }
}
