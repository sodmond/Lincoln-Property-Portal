<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerDetails extends Mailable
{
    use Queueable, SerializesModels;
    public $profile;
    public $ref_url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $profile, $ref_url)
    {
        $this->profile = $profile;
        $this->ref_url = $ref_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.customerDetails')
                    ->replyTo('info@lincolncityproperty.com')
                    ->subject("Registration Successful");
    }
}
