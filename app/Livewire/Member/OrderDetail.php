<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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

        $midtrans = new \App\Services\MidtransService();
        $snapToken = $midtrans->createSnapToken($this->order);
        
        $this->dispatch('snap-pay', token: $snapToken);
    }

    public function cancelOrder()
    {
        if ($this->order->status === 'menunggu') {
            $this->order->update(['status' => 'dibatalkan']);
            session()->flash('info', 'Pesanan berhasil dibatalkan.');
            $this->order->refresh();
        }
    }

    public function render()
    {
        return view('livewire.member.order-detail')->layout('layouts.app');
    }
}
