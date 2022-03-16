<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    public $touch;
    public $information;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($touch, $information)
    {
        $this->touch = $touch;
        $this->information = $information;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            //->from('contact@bio-nett.com', 'Bio-nett.com')
            ->subject($this->touch['objet'])
            ->view('client.contact_mail')
            ->with('touch', $this->touch)
            ->with('information', $this->information);
    }
}
