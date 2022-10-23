<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk')->insert([
            [
                'nama' => 'Nagasari',
                'deskripsi' => 'Terbuat dari Bahan dan Bumbu Pilihan',
                'foto' => 'produk.jpg',
                'harga' => '1500',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Timphan Ubi',
                'deskripsi' => 'Terbuat dari Bahan Pilihan dan Extra Pedas',
                'foto' => 'produk.jpg',
                'harga' => '2000',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Kue Dorayaki',
                'deskripsi' => 'Kue Khus Jepang ',
                'foto' => 'produk.jpg',
                'harga' => '15000',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Kue Ade',
                'deskripsi' => 'Dibuat dengan cita rasa yang tinggi ',
                'foto' => 'produk.jpg',
                'harga' => '3000',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Bolu Pandan',
                'deskripsi' => 'Dibuat dengan telur ayam pilihan ',
                'foto' => 'produk.jpg',
                'harga' => '35000',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],





        ]);
    }
}
