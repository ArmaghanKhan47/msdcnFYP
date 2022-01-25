<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'acount_provider',
        'qr_code',
        'user_id'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
