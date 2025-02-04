<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'admin',
            ],
            [
                'name' => 'petugas dinas',
                'email' => 'petugasdinas@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petugasDinas',
            ],
            [
                'name' => 'A1',
                'email' => 'a1@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A2',
                'email' => 'a2@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A3',
                'email' => 'a3@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A4',
                'email' => 'a4@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A5',
                'email' => 'a5@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A6',
                'email' => 'a6@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A7',
                'email' => 'a7@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A8',
                'email' => 'a8@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A9',
                'email' => 'a9@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A10',
                'email' => 'a10@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A11',
                'email' => 'a11@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A12',
                'email' => 'a12@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A13',
                'email' => 'a13@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A14',
                'email' => 'a14@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A15',
                'email' => 'a15@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A16',
                'email' => 'a16@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A17',
                'email' => 'a17@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A18',
                'email' => 'a18@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A19',
                'email' => 'a19@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A20',
                'email' => 'a20@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A21',
                'email' => 'a21@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A22',
                'email' => 'a22@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A23',
                'email' => 'a23@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A24',
                'email' => 'a24@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A25',
                'email' => 'a25@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A26',
                'email' => 'a26@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A27',
                'email' => 'a27@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A28',
                'email' => 'a28@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A29',
                'email' => 'a29@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A30',
                'email' => 'a30@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A31',
                'email' => 'a31@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A32',
                'email' => 'a32@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A33',
                'email' => 'a33@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A34',
                'email' => 'a34@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
            [
                'name' => 'A35',
                'email' => 'a35@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'petani',
            ],
        ]);


    }
}

