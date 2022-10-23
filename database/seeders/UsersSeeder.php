<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'level' => 'admin',
                'nama' => 'Saya Admin',
                'alamat' => 'Jalan Aspal, Banda Aceh',
                'password' => bcrypt('12345678'),
                'foto' => 'user.jpg',
                'email' => 'admin@gmail.com',
                'no_wa' => '085359071160',
                'status' => 'aktif',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],

            [
                'level' => 'pengguna',
                'nama' => 'Saya Operator',
                'alamat' => 'Jalan Aspal, Banda Aceh',
                'password' => bcrypt('12345678'),
                'foto' => 'user.jpg',
                'email' => 'operator@gmail.com',
                'no_wa' => '085359071161',
                'status' => 'aktif',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'level' => 'pengguna',
                'nama' => 'Saya Pengguna 2',
                'alamat' => 'Jalan Soekarno Hatta, Lampeunurut Aceh Besar',
                'password' => bcrypt('12345678'),
                'foto' => 'user.jpg',
                'email' => 'pengguna1@gmail.com',
                'no_wa' => '085359071162',
                'status' => 'aktif',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'level' => 'pengguna',
                'nama' => 'Saya Pengguna 3',
                'alamat' => 'Jalan Mohd Hasan, Lampeunurut Aceh Besar',
                'password' => bcrypt('12345678'),
                'foto' => 'user.jpg',
                'email' => 'pengguna3@gmail.com',
                'no_wa' => '085359071163',
                'status' => 'aktif',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],




        ]);

    }
}
