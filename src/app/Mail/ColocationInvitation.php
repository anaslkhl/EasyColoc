<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class ColocationInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $colocation;
    public $inviter;

    public function __construct($colocation, $inviter)
    {
        $this->colocation = $colocation;
        $this->inviter = $inviter;
    }

    public function build()
    {
        return $this->subject('Invitation to join colocation')
            ->view('emails.invitation');
    }
}
