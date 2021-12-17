<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'formula',
        'company',
        'type',
        'pic',
        'discription'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function inventorydistributor(){
        return $this->hasOne(InventoryDistributor::class,'medicine_id');
    }

    public function inventorydistributors(){
        return $this->hasMany(InventoryDistributor::class,'medicine_id');
    }

    public function inventoryretailer(){
        return $this->hasOne(InventoryRetailer::class,'medicine_id');
    }

    public function inventoryretailers(){
        return $this->hasMany(InventoryRetailer::class,'medicine_id');
    }
}
