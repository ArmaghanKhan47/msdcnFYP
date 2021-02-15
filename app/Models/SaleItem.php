<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'SaleItemId';

    protected $fillable = [
        'SaleId',
        'MedicineId',
        'Quantity',
        'SubTotal'
    ];
}
