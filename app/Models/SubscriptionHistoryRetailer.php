<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistoryRetailer extends Model
{
    use HasFactory;

    protected $primaryKey = 'HistoryId';

    protected $fillable = [
        'SubscriptionPackageId',
        'RetailerId',
        'startDate'
    ];

    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'SubscriptionPackageId');
    }
}
