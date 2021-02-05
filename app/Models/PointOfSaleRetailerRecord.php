<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointOfSaleRetailerRecord extends Model
{
    protected $primaryKey = 'RecordId';

    protected $fillable = [
        'RetailerShopId',
        'DailyRevenue'
    ];

    use HasFactory;

    public function record()
    {
        return $this->belongsTo(RetailerShop::class, 'RetailerShopId');
    }
}
