<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderConfirmedNotification extends Notification
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
                    ->subject('Pesanan Dikonfirmasi #' . $this->order->order_code)
                    ->greeting('Halo ' . $notifiable->name . ',')
                    ->line('Pesanan sewa baju adat Anda telah kami konfirmasi!')
                    ->line('Kode Pesanan: ' . $this->order->order_code)
                    ->line('Total Tagihan: Rp ' . number_format($this->order->total_payment, 0, ',', '.'))
                    ->action('Lakukan Pembayaran', url('/pesanan/' . $this->order->id))
                    ->line('Silakan segera selesaikan pembayaran Anda.');
    }
}
