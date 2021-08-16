<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InventoryMail extends Mailable
{
    use Queueable, SerializesModels;

    private $inventory_list;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inventory_list)
    {
        //
        $this->inventory_list = $inventory_list;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Low Inventory Alert')
        ->markdown('emails.inventory', [
            'inventory' => $this->inventory_list
        ]);
    }
}
