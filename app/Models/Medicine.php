<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medicine extends Model
{
    use HasFactory;

    protected $primaryKey = 'MedicineId';

    protected $hidden = ['created_at', 'updated_at'];

    public function inventory(){
        $this->hasOne(InventoryRetailer::class,'InventoryId');
    }
}
