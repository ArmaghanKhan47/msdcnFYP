<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryRetailer extends Model
{
    use HasFactory;

    protected $primaryKey = 'InventoryId';

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'MedicineId');
    }
}
