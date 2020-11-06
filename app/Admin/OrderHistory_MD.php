<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class OrderHistory_MD extends Model
{
    protected $table="order_history__m_d_s";
    protected $fillable=[
        'id',
        'user_id',
        'frontuser_id',
        'order_id',
        'itemid',
        'name',
        'qty',
        'price',
        'total'
    ];
}
