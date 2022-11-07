<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailRejet extends Mailable
{
    use Queueable, SerializesModels;

    public $dernierRejet = [];
    public $rejetUser = [];
    public $moisNDF;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dernierRejet,$rejetUser,$moisNDF)
    {
        $this->dernierRejet = $dernierRejet;
        $this->rejetUser = $rejetUser;
        $this->moisNDF = $moisNDF;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('compta@carpediem.pro')->subject('noreply Votre note de frais a été rejetée')->view('emails.MailRejet');
    }
}
