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
        'OrderCompletionDate'
    ];
}
