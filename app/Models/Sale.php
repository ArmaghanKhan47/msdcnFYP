<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_of_sale_id',
        'total',
        'discount',
        'payed'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'point_of_sale_id'
    ];

    public function saleitems(){
        return $this->hasMany(SaleItem::class, 'sale_id');
    }
}
