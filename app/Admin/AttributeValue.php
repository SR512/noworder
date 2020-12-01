<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table="attribute_values";
    protected $fillable=[
     'user_id',
     'item_id',
     'attribute_id',
     'qty',
     'price'
    ];
}
