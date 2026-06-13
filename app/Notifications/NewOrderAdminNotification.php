<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class NewOrderAdminNotification extends Notification
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
                    ->subject('Pesanan Baru #' . $this->order->order_code)
                    ->greeting('Halo Admin!')
                    ->line('Ada pesanan baru masuk dari pelanggan ' . $this->order->user->name . '.')
                    ->line('Kode Pesanan: ' . $this->order->order_code)
                    ->line('Baju Adat: ' . $this->order->costume->name)
                    ->action('Cek Pesanan di Dashboard', url('/admin/orders/' . $this->order->id))
                    ->line('Mohon segera konfirmasi pesanan ini agar pelanggan dapat melakukan pembayaran.');
    }
}
