<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory_MD extends Model
{
    protected $table="payment_history__m_d_s";
    protected $fillable=[
        'user_id',
        'frontuser_id',
        'order_id',
        'payment_id',
        'currency',
        'created',
        'status',
        'amount',
    ];
}
