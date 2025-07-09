<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminSendMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $messageContent;

    public function __construct($subjectLine, $messageContent)
    {
        $this->subjectLine = $subjectLine;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.admin_message')
                    ->with([
                        'messageContent' => $this->messageContent,
                    ]);
    }
}
