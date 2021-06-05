<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistoryDistributor extends Model
{
    use HasFactory;

    protected $primaryKey = 'HistoryId';

    protected $fillable = [
        'SubscriptionPackageId',
        'DistributorId',
        'startDate',
        'TransactionId',
        'PaymentMethod',
    ];

    protected $append = [
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
