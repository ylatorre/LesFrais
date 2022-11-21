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
    public $tableauChemins = [];


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$mois,$tableauChemins)
    {
        $this->username = $username;
        $this->mois = $mois;
        $this->tableauChemins = $tableauChemins;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // - On récupere les variables dont on a besoin

        $username = $this->username;
        $mois = $this->mois;
        $tableauChemins = $this->tableauChemins;

        // - On récupère le tableau contenant tous les chemins de cette ndf et on lui met les chemins exact de tous les évènements
        $piecesJointes = [];

        // - On génère le mail
        $email = $this->from('ComptaWeb@carpediem.pro')
                      ->view('emails.MailDuPDF')
                      ->subject('PDF de post-vadidation');

        // - On lui attache tous les chemins présents dans le tableau que l'on a implémenté précédement
        foreach ($tableauChemins as $tableauChemin) {
            $email->attachFromStorage($tableauChemin);
        }
        return $email;
    }
}
