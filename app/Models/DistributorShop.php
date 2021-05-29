<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorShop extends Model
{
    use HasFactory;

    protected $primaryKey = 'DistributorShopId';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'DistributorShopName',
        'LiscenceNo',
        'Region',
        'UserId',
        'ContactNumber',
        'LiscenceFrontPic'
    ];

    public function inventories(){
            return $this->hasMany(InventoryDistributor::class, 'DistributorShopId');
    }

    public function subscriptions()
    {
        return $this->hasMany(SubscriptionHistoryDistributor::class, 'DistributorId')->latest();
    }

    public function subscription()
    {
        return $this->hasOne(SubscriptionHistoryDistributor::class, 'DistributorId')->latest();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'DistributorId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }
}
