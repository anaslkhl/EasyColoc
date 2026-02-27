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
    public $invitation;

    public function __construct($colocation, $inviter, $invitation)
    {
        $this->colocation = $colocation;
        $this->inviter = $inviter;
        $this->invitation = $invitation;
    }

    public function build()
    {
        return $this->subject('Invitation to join colocation')
            ->view('emailsInvitation')->with([
                'colocation' => $this->colocation,
                'inviter' => $this->inviter,
                'invitation' => $this->invitation
            ]);
    }
}
