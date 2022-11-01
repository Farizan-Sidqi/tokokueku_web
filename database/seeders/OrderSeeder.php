<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Arr;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for ($i=0; $i < 7; $i++) {
        $tanggal = now()->day(1 + $i)->month(11)->hour(rand(00, 23))->minute(rand(00, 58));
        // $tanggal = now()->setDateTime(2022, 10, (17 + $i), rand(00, 58), rand(00, 58));
        Order::factory(rand(1,5))->create([
            'user_id' => User::where("level", "pengguna")->inRandomOrder()->first()->id,
            'total_qty' => 0,
            'total_harga' => 0,
            'tgl_order' => $tanggal,
            'is_paid' => Arr::random([true, false]),
            'created_at' => $tanggal,
            'updated_at' => $tanggal,
        ])->each(function ($order) use ($tanggal)
        {
            $total_jumlah = 0;
            $total_harga = 0;
            for ($o=0; $o < rand(1,4); $o++) {
                $produk = Produk::inRandomOrder()->first();
                $jumlah = rand(1,5);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'nama_makanan' => $produk->nama,
                    'harga_makanan' => $produk->harga,
                    'qty' => $jumlah,
                    'harga_total'=> $produk->harga * $jumlah,
                    'harga_total'=> $produk->modal,
                    'created_at' => $tanggal,
                    'updated_at' => $tanggal,
                ]);
                $total_jumlah += $jumlah;
                $total_harga += ($produk->harga * $jumlah);
            }
            $order->update([
                'total_qty' => $total_jumlah,
                'total_harga' => $total_harga,
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
        });
       }
    }
}
