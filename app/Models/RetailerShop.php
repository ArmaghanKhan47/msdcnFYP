<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerShop extends Model
{
    use HasFactory;

    protected $primaryKey = 'RetailerShopId';

    protected $hidden = ['created_at', 'updated_at'];

    public function inventories(){
            return $this->hasMany(InventoryRetailer::class, 'RetailerShopId');
    }

    public function subscriptions()
    {
        return $this->hasMany(SubscriptionHistoryRetailer::class, 'RetailerId');
    }
}
