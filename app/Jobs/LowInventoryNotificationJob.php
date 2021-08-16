<?php

namespace App\Jobs;

use App\Mail\InventoryMail;
use App\Models\User;
use App\Notifications\LowInventoryNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LowInventoryNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // This job will run in background check inventories of all available user
        // And issues the notification on low inventory

        $users = User::with([
            'retailershop.inventories' => function($query){
                $query->where('Quantity', '<=', '5');
            },
            'distributorshop.inventories' => function($query){
                $query->where('Quantity', '<=', '5');
            },
            'retailershop.inventories.medicine',
            'distributorshop.inventories.medicine'
        ])->get();

        foreach($users as $user)
        {
            switch($user->UserType){
                case 'Retailer':
                    if ($user->retailershop->inventories->isNotEmpty())
                    {
                        $user->notify(new LowInventoryNotification($user->retailershop->inventories));
                        Mail::to($user->email)->send(new InventoryMail($user->retailershop->inventories));
                    }
                    break;

                case 'Distributor':
                    if ($user->distributorshop->inventories->isNotEmpty())
                    {
                        $user->notify(new LowInventoryNotification($user->distributorshop->inventories));
                        Mail::to($user->email)->send(new InventoryMail($user->distributorshop->inventories));
                    }
                    break;
            }
        }
    }
}
