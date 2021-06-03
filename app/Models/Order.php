<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'OrderId';

    protected $fillable = [
        'RetailerId',
        'DistributorId',
        'OrderStatus',
        'PaymentMethod',
        'PayableAmount',
        'PayedDate',
        'OrderPlacingDate',
        'OrderCompletionDate',
        'deliveryAddress',
        'TransactionId'
    ];

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class, 'OrderId');
    }

    public function distributor()
    {
        return $this->belongsTo(DistributorShop::class, 'DistributorId');
    }

    public function retailer()
    {
        return $this->belongsTo(RetailerShop::class, 'RetailerId');
    }
}
