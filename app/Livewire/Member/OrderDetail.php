<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderDetail extends Component
{
    public $order;

    public function mount($id)
    {
        $this->order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->with(['costume.region', 'payment'])
            ->firstOrFail();
    }

    public function pay()
    {
        // Prevent paying if not waiting
        if ($this->order->status !== 'menunggu') {
            return;
        }

        $projectSlug = config('pakasir.project_slug');
        $amount = (int) $this->order->total_payment;
        $orderId = $this->order->order_code;
        $redirectUrl = route('member.order.detail', $this->order->id);
        
        $url = "https://app.pakasir.com/pay/{$projectSlug}/{$amount}?order_id={$orderId}&redirect={$redirectUrl}&qris_only=1";

        return redirect()->away($url);
    }

    public function cancelOrder()
    {
        if ($this->order->status === 'menunggu') {
            $this->order->update(['status' => 'dibatalkan']);
            session()->flash('info', 'Pesanan berhasil dibatalkan.');
            $this->order->refresh();
        }
    }

    public function checkPaymentStatus()
    {
        if ($this->order->status !== 'menunggu') {
            return;
        }

        $projectSlug = config('pakasir.project_slug');
        $apiKey = config('pakasir.api_key');
        $amount = (int) $this->order->total_payment;
        $orderId = $this->order->order_code;

        $response = Http::get("https://app.pakasir.com/api/transactiondetail", [
            'project' => $projectSlug,
            'amount' => $amount,
            'order_id' => $orderId,
            'api_key' => $apiKey
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['transaction']) && $data['transaction']['status'] === 'completed') {
                // Update Payment
                $payment = Payment::firstOrCreate(
                    ['order_id' => $this->order->id],
                    [
                        'gateway_order_id' => $orderId,
                        'payment_type' => $data['transaction']['payment_method'] ?? 'qris',
                        'gross_amount' => $amount,
                        'status' => 'pending'
                    ]
                );

                $payment->status = 'sukses';
                $payment->paid_at = isset($data['transaction']['completed_at']) ? \Carbon\Carbon::parse($data['transaction']['completed_at']) : now();
                $payment->save();

                // Update Order
                $this->order->status = 'dibayar';
                $this->order->save();
                
                // Notify user
                $this->order->user->notify(new \App\Notifications\PaymentSuccessNotification($this->order));

                session()->flash('success', 'Pembayaran berhasil dikonfirmasi!');
                $this->order->refresh();
                return;
            } else if (isset($data['transaction']) && in_array($data['transaction']['status'], ['failed', 'expired', 'canceled'])) {
                $this->order->update(['status' => 'dibatalkan']);
                session()->flash('info', 'Pesanan dibatalkan karena pembayaran ' . $data['transaction']['status']);
                $this->order->refresh();
                return;
            }
        } else {
            $errorMsg = $response->json('message') ?? 'Terjadi kesalahan komunikasi dengan server.';
            session()->flash('error', "Gagal mengecek status: {$errorMsg} (Coba restart server artisan Anda jika baru merubah .env)");
            return;
        }

        session()->flash('info', 'Status pembayaran masih menunggu atau belum ada data pembayaran baru.');
    }

    public function render()
    {
        return view('livewire.member.order-detail')->layout('layouts.app');
    }
}
