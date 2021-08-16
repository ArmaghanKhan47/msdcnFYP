<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    private $title;
    private $body;
    private User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $title, $body)
    {
        //
        $this->title = $title;
        $this->body = $body;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email)
        ->subject('Account Alert')
        ->markdown('emails.user_account', [
            'title' => $this->title,
            'body' => $this->body
        ]);
    }
}
