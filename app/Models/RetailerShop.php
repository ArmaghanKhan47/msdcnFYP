<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerShop extends Model
{
    use HasFactory;

    protected $primaryKey = 'RetailerShopId';

    public function inventory()
    {
        return $this->hasMany(InventoryRetailer::class, 'RetailerShopId');
    }
}
