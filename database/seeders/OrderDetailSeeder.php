<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_detail')->insert([
            [
                'order_id' => '1',
                'nama_makanan' => 'Nagasari',
                'harga_makanan' => '1500',                	
                'qty' => '2',
                'harga_total' => '3000',
                'created_at' => date('2022-07-01 00:00:01'),
                'updated_at' => date('2022-07-01 00:00:01')
            ],
            [
                'order_id' => '1',
                'nama_makanan' => 'Kue Dorayaki',
                'harga_makanan' => '15000',                	
                'qty' => '3',
                'harga_total' => '45000',
                'created_at' => date('2022-07-01 00:00:01'),
                'updated_at' => date('2022-07-01 00:00:01')
            ],
            [
                'order_id' => '2',
                'nama_makanan' => 'Timphan Ubi',
                'harga_makanan' => '2000',                	
                'qty' => '50',
                'harga_total' => '100000',
                'created_at' => date('2022-07-08 00:00:01'),
                'updated_at' => date('2022-07-08 00:00:01')
            ],
            [
                'order_id' => '3',
                'nama_makanan' => 'Kue Ade',
                'harga_makanan' => '3000',                	
                'qty' => '30',
                'harga_total' => '90000',
                'created_at' => date('2022-07-15 00:00:01'),
                'updated_at' => date('2022-07-15 00:00:01')
            ],
            [
                'order_id' => '3',
                'nama_makanan' => 'Timphan Ubi',
                'harga_makanan' => '2000',                	
                'qty' => '14',
                'harga_total' => '28000',
                'created_at' => date('2022-07-15 00:00:01'),
                'updated_at' => date('2022-07-15 00:00:01')
            ],
            [
                'order_id' => '4',
                'nama_makanan' => 'Timphan Ubi',
                'harga_makanan' => '2000',                	
                'qty' => '40',
                'harga_total' => '80000',
                'created_at' => date('2022-07-22 00:00:01'),
                'updated_at' => date('2022-07-22 00:00:01')
            ],
            [
                'order_id' => '5',
                'nama_makanan' => 'Timphan Ubi',
                'harga_makanan' => '2000',                	
                'qty' => '40',
                'harga_total' => '80000',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'order_id' => '5',
                'nama_makanan' => 'Kue Ade',
                'harga_makanan' => '3000',                	
                'qty' => '4',
                'harga_total' => '12000',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],

        ]);
    }
}
