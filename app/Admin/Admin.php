<?php

namespace App\Admin;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'category_id','businessname','address','state','city','status','razor_key','razor_secret','iscod','ispayment','fb','insta','youtube','whatsapp','gst','isgst','isopen','time'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'payment_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function getCategory()
    {
        return $this->belongsTo('App\Admin\Category','category_id');
    }
}
