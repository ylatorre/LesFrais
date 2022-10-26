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
    public $i;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$mois,$i)
    {
        $this->username = $username;
        $this->mois = $mois;
        $this->i = $i;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //- On récupere les variables dont on a besoin
        $i = $this->i;
        $username = $this->username;
        $mois = $this->mois;
        $filename = $username.' - '.$mois;

        //on crée un tableau piècesJointes et on lui met les chemins exact de tous les évènements
        $piecesJointes = [];

        for ($k=0; $k < $i ; $k++) {
            array_push($piecesJointes,"public/pdf/".$filename.$k.'.pdf');
        }
        // - On génère le mail
        $email = $this->from('compta@carpediem.pro')
                    ->view('emails.mailDuPDF')
                    ->subject('PDF de post-vadidation');

        // on lui attache tous les chemi présents dans le tableau que l'on a implémenté précédement
        foreach ($piecesJointes as $piecesJointe) {
            $email->attachFromStorage($piecesJointe);
        }

        return $email;

    }
}
