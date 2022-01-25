<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'senderable_id',
        'senderable_type',
        'content'
    ];

    public function senderable(){
        return $this->morphTo();
    }

    public function chat(){
        return $this->belongsTo(Chat::class, 'chat_id', 'id');
    }
}
