<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PDFmail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $mois;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$mois)
    {
        $this->username = $username;
        $this->mois = $mois;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $username = $this->username;
        $mois = $this->mois;

        $filename = $username.' - '.$mois.'.pdf';

        return $this->from('compta@carpediem.pro')
                    ->view('emails.mailDuPDF')
                    ->subject('PDF de post-vadidation')
                    ->attachFromStorage("public/pdf/" . $filename);
    }
}
