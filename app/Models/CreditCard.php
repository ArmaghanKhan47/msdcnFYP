<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $primaryKey = 'rowId';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'CardHolderName',
        'CardNumber',
        'ExpiryMonth',
        'ExpiryYear',
        'cvv'
    ];

}
