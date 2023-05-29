<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointOfSaleRetailerRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'retailer_id',
        'daily_revenue'
    ];


    public function record(){
        return $this->belongsTo(Retailer::class, 'retailer_id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'point_of_sale_id');
    }
}
