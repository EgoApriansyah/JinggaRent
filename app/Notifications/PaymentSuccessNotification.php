<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class PaymentSuccessNotification extends Notification
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
                    ->subject('Pembayaran Berhasil #' . $this->order->order_code)
                    ->greeting('Halo ' . $notifiable->name . ',')
                    ->line('Kami telah menerima pembayaran Anda sebesar Rp ' . number_format($this->order->total_payment, 0, ',', '.') . '.')
                    ->line('Pesanan Anda sekarang berstatus AKTIF.')
                    ->line('Silakan datang untuk mengambil baju adat pada tanggal ' . \Carbon\Carbon::parse($this->order->start_date)->format('d M Y') . '.')
                    ->action('Lihat Detail Pesanan', url('/pesanan/' . $this->order->id))
                    ->line('Terima kasih telah mempercayakan momen spesial Anda kepada JinggaRent.');
    }
}
