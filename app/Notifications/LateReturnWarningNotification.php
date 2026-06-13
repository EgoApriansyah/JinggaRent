<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class LateReturnWarningNotification extends Notification
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
                    ->subject('PERINGATAN: Keterlambatan Pengembalian Baju Adat')
                    ->greeting('Halo ' . $notifiable->name . ',')
                    ->line('Menurut catatan kami, masa sewa Anda untuk pesanan #' . $this->order->order_code . ' telah melewati batas waktu pengembalian pada tanggal ' . \Carbon\Carbon::parse($this->order->end_date)->format('d M Y') . '.')
                    ->line('Mohon segera kembalikan baju adat ke toko kami.')
                    ->line('Perlu diketahui bahwa deposit Anda mungkin akan tertahan atau dikurangi sesuai dengan kebijakan JinggaRent jika keterlambatan terus berlanjut.')
                    ->action('Hubungi Kami', url('/kontak'))
                    ->line('Jika Anda sudah mengembalikan, mohon abaikan pesan ini.');
    }
}
