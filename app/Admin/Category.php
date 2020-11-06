<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="categories";

    protected $fillable=[
        'user_id',
        'name',
        'status'
    ];
}
