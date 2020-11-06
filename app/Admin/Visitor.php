<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table="visitors";
    protected $fillable=[
        'user_id',
        'ip',
        'countryName',
        'countryCode',
        'regionCode',
        'regionName',
        'cityName',
        'zipCode',
        'latitude',
        'longitude',
    ];
}
