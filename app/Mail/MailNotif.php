<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotif extends Mailable
{
    use Queueable, SerializesModels;

    public $modo = [];
    public $i = 0;
    public $actualUser = [];
    public $monthNDF = [];


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($moderators,$i,$actualUser,$monthNDF)
    {
        $this->modo = $moderators[$i];
        $this->actualUser = $actualUser;
        $this->monthNDF = $monthNDF;



    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('compta@carpediem.pro')->subject('Demande de validation de Note de frais.')->view('emails.MailNotif');
    }
}
