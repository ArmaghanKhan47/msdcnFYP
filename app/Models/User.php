<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'UserType',
        'AccountStatus',
        'CnicCardNumber',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function retailershop()
    {
        return $this->hasOne(RetailerShop::class, 'UserId');
    }

    public function distributorshop()
    {
        return $this->hasOne(DistributorShop::class, 'UserId');
    }

    public function creditcard()
    {
        return $this->hasOne(CreditCard::class, 'rowId');
    }
}
