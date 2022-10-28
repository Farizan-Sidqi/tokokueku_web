<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'snap_token',
        'mt_order_id',
        'mt_transaction_id',
        'transaction_status',
        'status_message',
        'payment_type',
        'payment_code',
        'code',
        'settlement_time',
        'response'
    ];
}
