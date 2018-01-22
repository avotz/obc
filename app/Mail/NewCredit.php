<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Credit;

class NewCredit extends Mailable
{
    use Queueable, SerializesModels;

    public $credit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Credit $credit)
    {
        $this->credit = $credit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Credit response')->markdown('emails.credits.newCredit');
    }
}
