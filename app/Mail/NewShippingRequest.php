<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\ShippingRequest;

class NewShippingRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $shippingRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ShippingRequest $shippingRequest)
    {
        $this->shippingRequest = $shippingRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Shipping Request')->markdown('emails.shippings.newShippingRequest');
    }
}
