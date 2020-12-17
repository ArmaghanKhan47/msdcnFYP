<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryRetailer extends Model
{
    use HasFactory;

    protected $primaryKey = 'InventoryId';

    public function retailer()
    {
        return $this->belongsTo(RetailerShop::class, 'foreign_key', 'local_key');
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'MedicineId');
    }
}
