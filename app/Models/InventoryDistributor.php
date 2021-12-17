<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDistributor extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'distributor_id',
        'medicine_id',
        'quantity',
        'unit_price'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function distributor()
    {
        return $this->belongsTo(DistributorShop::class, 'distributor_id');
    }
}
