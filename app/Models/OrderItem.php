<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'medicine_id',
        'quantity',
        'sub_total'
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function medicine(){
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

}

?>
