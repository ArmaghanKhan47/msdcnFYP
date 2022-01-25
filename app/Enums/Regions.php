<?php

namespace App\Enums;

class Regions{
    public static $HAZARA = 'haraza';
    public static $RAWALPINDHI = 'rawalpindhi';
    public static $LAHORE = 'lahore';

    protected static $regions = [
        'haraza',
        'rawalpindhi',
        'lahore'
    ];

    public static function length(){
        return count(self::$regions);
    }

    public static function list(){
        return self::$regions;
    }
}
