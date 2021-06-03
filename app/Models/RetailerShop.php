<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerShop extends Model
{
    use HasFactory;

    protected $primaryKey = 'RetailerShopId';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'RetailerShopName',
        'LiscenceNo',
        'Region',
        'UserId',
        'ContactNumber',
        'LiscenceFrontPic'
    ];

    public function inventories(){
            return $this->hasMany(InventoryRetailer::class, 'RetailerShopId');
    }

    public function subscriptions()
    {
        return $this->hasMany(SubscriptionHistoryRetailer::class, 'RetailerId')->latest();
    }

    public function subscription()
    {
        return $this->hasOne(SubscriptionHistoryRetailer::class, 'RetailerId')->latest();
    }

    public function pointofsale()
    {
        return $this->hasMany(PointOfSaleRetailerRecord::class, 'RetailerShopId');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'RetailerId');
    }
}
