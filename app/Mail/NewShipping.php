<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Shipping;

class NewShipping extends Mailable
{
    use Queueable, SerializesModels;

    public $shipping;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Shipping response')->markdown('emails.shippings.newShipping');
    }
}
