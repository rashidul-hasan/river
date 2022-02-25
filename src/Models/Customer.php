<?php

namespace Rashidul\River\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','dob','address'
    ];

    protected $guard = 'customer';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function wishlistProducts()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function reviews(){

        return $this->hasMany(Review::class);
    }

    public function isOnline()
    {
        return Cache::has('user_online_check' . $this->id);
    }
}
