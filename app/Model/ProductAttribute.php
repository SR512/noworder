<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table="product_attributes";
    protected $fillable=[
      'user_id',
      'attribute',
      'status'
    ];
}
