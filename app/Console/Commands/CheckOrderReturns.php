<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckOrderReturns extends Command
{
    protected $signature = 'orders:check-returns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek pesanan yang mendekati waktu pengembalian atau terlambat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = \Carbon\Carbon::today();
        $tomorrow = \Carbon\Carbon::tomorrow();

        // 1. Pesanan H-1 Pengembalian
        $h1Orders = \App\Models\Order::where('status', 'aktif')
            ->whereDate('end_date', $tomorrow)
            ->get();

        foreach ($h1Orders as $order) {
            $order->user->notify(new \App\Notifications\ReturnReminderNotification($order));
            \Illuminate\Support\Facades\Log::info("Pengingat H-1 untuk Order {$order->order_code} - User: {$order->user->email}");
        }

        // 2. Pesanan Terlambat (Melewati end_date)
        $lateOrders = \App\Models\Order::where('status', 'aktif')
            ->whereDate('end_date', '<', $today)
            ->get();

        foreach ($lateOrders as $order) {
            $order->user->notify(new \App\Notifications\LateReturnWarningNotification($order));
            \Illuminate\Support\Facades\Log::info("Peringatan Keterlambatan untuk Order {$order->order_code} - User: {$order->user->email}");
        }

        $this->info('Pengecekan pengembalian pesanan selesai.');
    }
}
