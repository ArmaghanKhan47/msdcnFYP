<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistoryDistributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'SubscriptionPackageId',
        'DistributorId',
        'startDate'
    ];

    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'SubscriptionPackageId');
    }
}
