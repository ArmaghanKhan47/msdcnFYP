<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    use HasFactory;

    protected $primaryKey = 'PackageId';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
