<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PakasirWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        
        $orderId = $request->input('order_id');
        $status = $request->input('status');
        $amount = $request->input('amount');
        $project = $request->input('project');
        
        // Basic check to see if project slug matches
        if ($project !== config('pakasir.project_slug')) {
            Log::warning('Pakasir Webhook: Invalid project slug', ['project' => $project]);
            return response()->json(['message' => 'Invalid project'], 400);
        }

        $order = Order::where('order_code', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $payment = Payment::firstOrCreate(
            ['order_id' => $order->id],
            [
                'gateway_order_id' => $orderId,
                'payment_type' => $request->input('payment_method', 'qris'),
                'gross_amount' => $amount,
                'status' => 'pending'
            ]
        );

        if ($status === 'completed') {
            $payment->status = 'sukses';
            $payment->paid_at = $request->input('completed_at') ? \Carbon\Carbon::parse($request->input('completed_at')) : now();
            
            $order->status = 'dibayar';
            $order->user->notify(new \App\Notifications\PaymentSuccessNotification($order));
        } else if ($status === 'failed' || $status === 'expired' || $status === 'canceled') {
            $payment->status = 'gagal';
            $order->status = 'dibatalkan';
        }

        $payment->save();
        $order->save();

        return response()->json(['message' => 'Webhook received']);
    }
}
