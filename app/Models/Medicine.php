<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function inventory() {
        return $this->hasOne(Inventory::class,'medicine_id');
    }
}
