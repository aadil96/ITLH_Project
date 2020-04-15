<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProposal extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    public $assignment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $assignment)
    {
        $this->user = $user;
        $this->assignment = $assignment;
        // dd($user);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new-proposal');
    }
}
