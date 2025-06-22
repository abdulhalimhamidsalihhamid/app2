<?php

namespace App\Notifications;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class FacultyEmailVerification extends Notification
{
    protected $faculty;

    public function __construct($faculty)
    {
        $this->faculty = $faculty;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

public function toMail($notifiable)
{
    $url = URL::temporarySignedRoute(
        'faculty.verify',
        Carbon::now()->addMinutes(60),
        ['id' => $this->faculty->id]
    );

    return (new MailMessage)
        ->subject('تأكيد البريد الإلكتروني')
        ->greeting('مرحباً!')
        ->line('يرجى الضغط على الزر أدناه لتأكيد بريدك الإلكتروني.')
        ->action('تأكيد البريد الإلكتروني', $url)
        ->line('إذا لم تقم بإنشاء حساب، فلا داعي لأي إجراء.');
}

}

