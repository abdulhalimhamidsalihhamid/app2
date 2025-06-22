<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FacultyVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $facultyName;
    public $url;

    public function __construct($facultyName, $url)
    {
        $this->facultyName = $facultyName;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('تأكيد البريد الإلكتروني')
                    ->view('emails.faculty_verification');
    }
}
