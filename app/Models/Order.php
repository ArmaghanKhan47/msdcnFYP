<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'retailer_id',
        'distributor_id',
        'is_accepted',
        'is_cancelled',
        'is_dispatched',
        'is_completed',
        'is_paid',
        'payment_method',
        'payable_amount',
        'payed_date',
        'order_placing_date',
        'order_completion_date',
        'delivery_address',
        'transaction_id'
    ];

    public function orderitems(){
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function distributor(){
        return $this->belongsTo(Distributor::class, 'distributor_id');
    }

    public function retailer(){
        return $this->belongsTo(Retailer::class, 'retailer_id');
    }

    public function getStatusAttribute(){

    }
}
