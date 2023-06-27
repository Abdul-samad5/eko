<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class deliverymail extends Mailable
{
    use Queueable, SerializesModels;
    public $deliveryMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($deliveryMail)
    {
        $this->deliveryMail = $deliveryMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('DELIVERY RESPONSE FROM EKO-MARKET')->view('email.deliverymail');
    }
}
