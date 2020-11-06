<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = "sliders";

    protected $fillable = [
        'user_id',
        'name',
        'subtitle',
        'backgroundphoto',
        'status'
    ];
}
