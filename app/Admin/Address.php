<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "addresses";

    protected $fillable = [
        'frontuser_id',
        'address_line_1',
        'address_pincode',
        'address_landmark',
    ];

}
