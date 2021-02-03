<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'ItemId';

    protected $fillable = [
        'OrderId',
        'MedicineId',
        'Quantity',
        'Subtotal'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderId');
    }

    public function medicine()
    {
        return $this->hasOne(Medicine::class, 'MedicineId');
    }

}

?>
