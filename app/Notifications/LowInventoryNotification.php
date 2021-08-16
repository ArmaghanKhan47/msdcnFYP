<?php

namespace App\Notifications;

use App\Mail\InventoryMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class LowInventoryNotification extends Notification
{
    use Queueable, SerializesModels;

    private $inventory_items;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($inventory_items)
    {
        //
        $this->inventory_items = $inventory_items;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new InventoryMail($this->inventory_items))
        ->subject('Low Inventory Alert')
        ->onQueue('email');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'status' => 'info',
            'message' => 'Low Inventory'
        ];
    }
}
