<?php
// app/Mail/MailSend.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Verifikasi Akun - DP3A Tolikara')
                    ->view('emails.verifikasi')
                    ->with('details', $this->details);
    }
}