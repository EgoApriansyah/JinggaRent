<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class PaymentPendingNotification extends Notification
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
                    ->subject('Menunggu Pembayaran #' . $this->order->order_code)
                    ->greeting('Halo ' . $notifiable->name . ',')
                    ->line('Pesanan Anda #' . $this->order->order_code . ' sedang menunggu pembayaran.')
                    ->line('Total Tagihan (termasuk Deposit): Rp ' . number_format($this->order->total_payment, 0, ',', '.'))
                    ->action('Bayar Sekarang', url('/pesanan/' . $this->order->id))
                    ->line('Mohon segera selesaikan pembayaran agar pesanan dapat diproses lebih lanjut.');
    }
}
