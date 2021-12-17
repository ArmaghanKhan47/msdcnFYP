<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerShop extends Model
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
        'user_id',
        'contact_no',
        'liscence_front_pic'
    ];

    public function inventories(){
            return $this->hasMany(InventoryRetailer::class, 'retailer_id');
    }

    public function subscriptions(){
        return $this->hasMany(SubscriptionHistoryRetailer::class, 'retailer_id')->latest();
    }

    public function subscription(){
        return $this->hasOne(SubscriptionHistoryRetailer::class, 'retailer_id')->latest();
    }

    public function pointofsale(){
        return $this->hasMany(PointOfSaleRetailerRecord::class, 'retailer_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'retailer_id');
    }
}
