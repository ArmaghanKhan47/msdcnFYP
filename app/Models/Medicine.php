<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medicine extends Model
{
    use HasFactory;

    protected $primaryKey = 'MedicineId';

    protected $fillable = [
        'MedicineName',
        'MedicineFormula',
        'MedicineCompany',
        'MedicineType',
        'MedicinePic',
        'MedicineDiscription'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function inventorydistributor(){
        return $this->hasOne(InventoryDistributor::class,'MedicineId');
    }

    public function inventorydistributors(){
        return $this->hasMany(InventoryDistributor::class,'MedicineId');
    }

    public function inventoryretailer(){
        return $this->hasOne(InventoryRetailer::class,'MedicineId');
    }

    public function inventoryretailers(){
        return $this->hasMany(InventoryRetailer::class,'MedicineId');
    }
}
