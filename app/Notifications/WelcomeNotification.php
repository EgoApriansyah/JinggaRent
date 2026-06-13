<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Selamat Datang di JinggaRent')
                    ->greeting('Halo, ' . $notifiable->name . '!')
                    ->line('Terima kasih telah bergabung dengan JinggaRent, layanan sewa baju adat premium terbaik.')
                    ->action('Mulai Eksplorasi Katalog', url('/katalog'))
                    ->line('Kami menantikan pesanan pertama Anda!');
    }
}
