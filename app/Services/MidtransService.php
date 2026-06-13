<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createSnapToken(Order $order)
    {
        // Parameter for Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->total_payment, // Total includes deposit
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone,
            ],
            'item_details' => [
                [
                    'id' => $order->costume->id . '-SEWA',
                    'price' => $order->costume->price_per_day,
                    'quantity' => \Carbon\Carbon::parse($order->start_date)->diffInDays(\Carbon\Carbon::parse($order->end_date)) + 1,
                    'name' => 'Sewa ' . $order->costume->name,
                ],
                [
                    'id' => $order->costume->id . '-DEPOSIT',
                    'price' => $order->deposit_amount,
                    'quantity' => 1,
                    'name' => 'Deposit (Dikembalikan)',
                ]
            ]
        ];

        return Snap::getSnapToken($params);
    }
}
