<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class surveymail extends Mailable
{
    use Queueable, SerializesModels;
    public $surveyMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($surveyMail)
    {
        $this->surveyMail = $surveyMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('SURVEY RESPONSE FROM EKO-MARKET')->view('email.surveymail');

    }
}
