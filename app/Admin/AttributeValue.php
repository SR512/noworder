<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = "attribute_values";
    protected $fillable = [
        'user_id',
        'item_id',
        'attribute_id',
        'value',
        'qty',
        'price'
    ];

    public function getItem()
    {
        return $this->belongsTo('App\Admin\Item', 'item_id');
    }

    public function getAttributeName()
    {
        return $this->belongsTo('App\Model\ProductAttribute', 'attribute_id');
    }
}
