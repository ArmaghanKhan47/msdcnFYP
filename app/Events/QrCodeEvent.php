<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;

class QrCodeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public UploadedFile $qrcode;
    public User $user;
    public array $additional_parameter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($qrcode, $user, $additional_parameter)
    {
        //
        $this->qrcode = $qrcode;
        $this->user = $user;
        $this->additional_parameter = $additional_parameter;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
