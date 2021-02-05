<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDistributor extends Model
{
    use HasFactory;

    protected $primaryKey = 'InventoryId';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'DistributorShopId',
        'MedicineId',
        'Quantity',
        'UnitPrice'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'MedicineId');
    }

    public function distributor()
    {
        return $this->belongsTo(DistributorShop::class, 'DistributorShopId');
    }
}
