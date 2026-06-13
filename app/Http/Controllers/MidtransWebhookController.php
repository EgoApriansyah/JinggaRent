<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            Log::error('Midtrans Webhook Exception: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;
        $paymentType = $notification->payment_type;

        $order = Order::where('order_code', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $payment = Payment::firstOrCreate(
            ['order_id' => $order->id],
            [
                'midtrans_order_id' => $orderId,
                'payment_type' => $paymentType,
                'amount' => $notification->gross_amount,
                'status' => 'pending'
            ]
        );

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $payment->status = 'challenge';
            } else if ($fraudStatus == 'accept') {
                $payment->status = 'sukses';
                $order->status = 'dibayar';
                $order->user->notify(new \App\Notifications\PaymentSuccessNotification($order));
            }
        } else if ($transactionStatus == 'settlement') {
            $payment->status = 'sukses';
            $order->status = 'dibayar';
            $order->user->notify(new \App\Notifications\PaymentSuccessNotification($order));
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $payment->status = 'gagal';
            $order->status = 'dibatalkan';
        } else if ($transactionStatus == 'pending') {
            $payment->status = 'pending';
        }

        $payment->save();
        $order->save();

        return response()->json(['message' => 'Webhook received']);
    }
}
