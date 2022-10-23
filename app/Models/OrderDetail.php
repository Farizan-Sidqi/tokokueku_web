<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;


    protected $table = 'order_detail';
    protected $fillable = [
        'order_id',
        'nama_makanan',
        'harga_makanan',
        'qty',
        'harga_total',
        'created_at',
        'updated_at'
    ];
    // public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
