<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointOfSaleRetailerRecord extends Model
{
    protected $fillable = [
        'retailer_id',
        'daily_revenue'
    ];

    use HasFactory;

    public function record()
    {
        return $this->belongsTo(RetailerShop::class, 'retailer_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'point_of_sale_id');
    }
}
