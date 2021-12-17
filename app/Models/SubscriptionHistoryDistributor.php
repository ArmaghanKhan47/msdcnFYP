<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistoryDistributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_package_id',
        'distributor_id',
        'start_date',
        'transaction_id',
        'payment_method',
    ];

    protected $append = [
        'end_date'
    ];

    public function package(){
        return $this->belongsTo(SubscriptionPackage::class, 'subscription_package_id');
    }

    public function getEndDateAttribute(){
        return date('Y-m-d', strtotime($this->start_date . "+".(string)$this->package->duration." months"));
    }
}
