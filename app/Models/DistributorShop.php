<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorShop extends Model
{
    use HasFactory;

    protected $primaryKey = 'DistributorShopId';

    protected $hidden = ['created_at', 'updated_at'];

    public function inventories(){
            return $this->hasMany(InventoryDistributor::class, 'DistributorShopId');
    }
}
