<?php

namespace App\Models;

use App\Enums\AccountStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_status',
        'cnic_card_no',
        'api_token',
        'cnic_front_pic',
        'cnic_back_pic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'updated_at',
        'userable_type',
        'userable_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'account_status' => AccountStatus::class
    ];

    public function userable(){
        return $this->morphTo();
    }

    public function mobilebank()
    {
        return $this->hasOne(MobileBank::class, 'id', 'mobile_bank_id');
    }

    public function getTypeAttribute(){
        switch ($this->attributes['userable_type']){
            case 'App\Models\Retailer':
                return 'retailer';

            case 'App\Models\Distributor':
                return 'distributor';
        }
    }

    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email;
    }

    public function scopePending($query){
        return $query->where('account_status', AccountStatus::$PENDING);
    }

    public function scopeRetailers($query){
        return $query->whereHasMorph('userable', Retailer::class);
    }

    public function scopeDistributors($query){
        return $query->whereHasMorph('userable', Distributor::class);
    }
}
