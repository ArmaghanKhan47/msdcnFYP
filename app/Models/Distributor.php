<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'shop_name',
        'liscence_no',
        'region',
        'contact_no',
        'liscence_front_pic'
    ];

    public function inventories(){
            return $this->morphMany(Inventory::class, 'ownerable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'distributor_id');
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
