<?php

namespace App\Enums;

class AccountStatus{
    public static $ACTIVE = 'active';
    public static $PENDING = 'pending';
    public static $DEACTIVE = 'deactive';

    protected static $statuses = [
        'pending',
        'active',
        'deactive'
    ];

    public static function length(){
        return count(self::$statuses);
    }

    public static function list(){
        return self::$statuses;
    }
}
