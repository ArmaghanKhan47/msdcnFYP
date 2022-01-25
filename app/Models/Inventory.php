<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'medicine_id',
        'quantity',
        'unit_price'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function scopeLow($query)
    {
        return $query->where('quantity', '<=', '5');
    }

    public function ownerable(){
        return $this->morphTo();
    }
}
