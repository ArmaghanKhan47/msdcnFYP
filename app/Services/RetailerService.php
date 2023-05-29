<?php

namespace App\Services;

use App\Models\Retailer;

class RetailerService {

    public static function getTodaySales($userId) {
        return static::getSalesByDate($userId, date('Y-m-d'));
    }

    public static function getSalesByDate($userId, $date) {
        return Retailer::with(['pointofsale' => function($query) use ($date){
            $query->where('created_at', 'LIKE', $date .'%');
        },
        'pointofsale.sales' => function($query){
            $query->orderBy('updated_at', 'asc');
        },
        'pointofsale.sales.saleitems'])
        ->where('userable_id', $userId)->first()->pointofsale;
    }
}
