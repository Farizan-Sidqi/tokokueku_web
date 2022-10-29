<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'user_id',
        'total_qty',
        'total_harga',
        'catatan',
        'alamat_antar',
        'tgl_order',
        'status',
        'is_paid',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
        //return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
