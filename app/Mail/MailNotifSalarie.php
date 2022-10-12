<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotifSalarie extends Mailable
{
    use Queueable, SerializesModels;

    public $moderator = [];
    public $salarie = [];
    public $moisNDF;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($moderator,$salarie,$moisNDF)
    {
        $this->moderator = $moderator;
        $this->salarie = $salarie;
        $this->moisNDF = $moisNDF;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('compta@carpediem.pro')->subject('noreply Votre note de frais a été validée')->view('emails.MailNotifSalarie');
    }
}
