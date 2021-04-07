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

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'endDate'
    ];

    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'SubscriptionPackageId');
    }

    public function getEndDateAttribute()
    {
        return date('Y-m-d', strtotime($this->startDate . "+".(string)$this->package->PackageDuration." months"));
    }
}
