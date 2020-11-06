<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'user_id',
        'frontuser_id',
        'address_id',
        'ordernumber',
        'orderpickup',
        'payemttype',
        'total',
        'status'
    ];

    public function getFrontendUser()
    {
        return $this->belongsTo('App\User','frontuser_id');
    }
    public function getAddress()
    {
        return $this->belongsTo('App\Admin\Address','address_id');
    }
}
