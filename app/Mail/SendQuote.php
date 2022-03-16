<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQuote extends Mailable
{
    use Queueable, SerializesModels;

    public $devis;
    public $information;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($devis, $information)
    {
        $this->devis = $devis;
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
            ->subject('Demande de dévis')
            ->view('client.devis_mail')
            ->with('information', $this->information)
            ->with('devis', $this->devis);
    }
}
