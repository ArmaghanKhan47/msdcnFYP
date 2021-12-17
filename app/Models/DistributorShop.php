<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorShop extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'shop_name',
        'liscence_no',
        'region',
        'contact_no',
        'liscence_front_pic'
    ];

    public function inventories(){
            return $this->hasMany(InventoryDistributor::class, 'distributor_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(SubscriptionHistoryDistributor::class, 'distributor_id')
        ->latest();
    }

    public function subscription()
    {
        return $this->hasOne(SubscriptionHistoryDistributor::class, 'distributor_id')
        ->latest();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'distributor_id');
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
