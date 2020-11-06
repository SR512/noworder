<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'caption',
        'image',
        'price',
        'discount',
        'discountprice',
        'description',
        'isMultiMedia',
        'status'
    ];

    public function getCategory()
    {
        return $this->belongsTo('App\Admin\Category','category_id');
    }
}
