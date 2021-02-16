<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $primaryKey = 'SaleId';

    protected $fillable = [
        'PointOfSaleId',
        'Total',
        'Discount',
        'Payed'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'PointOfSaleId'
    ];

    public function saleitems()
    {
        return $this->hasMany(SaleItem::class, 'SaleId');
    }
}
