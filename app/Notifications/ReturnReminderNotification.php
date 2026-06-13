<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class ReturnReminderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Pengingat: Besok Waktunya Mengembalikan Baju Adat')
                    ->greeting('Halo ' . $notifiable->name . ',')
                    ->line('Kami ingin mengingatkan bahwa masa sewa baju adat Anda akan berakhir besok (' . \Carbon\Carbon::parse($this->order->end_date)->format('d M Y') . ').')
                    ->line('Kode Pesanan: ' . $this->order->order_code)
                    ->line('Mohon kembalikan baju adat tepat waktu untuk menghindari keterlambatan.')
                    ->action('Lihat Petunjuk Pengembalian', url('/faq'))
                    ->line('Terima kasih!');
    }
}
