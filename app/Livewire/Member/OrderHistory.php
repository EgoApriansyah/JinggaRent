<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistory extends Component
{
    use WithPagination;

    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
        if ($order && $order->status === 'menunggu') {
            $order->update(['status' => 'dibatalkan']);
            session()->flash('info', 'Pesanan berhasil dibatalkan.');
        }
    }

    public function render()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['costume', 'payment'])
            ->latest()
            ->paginate(10);

        return view('livewire.member.order-history', [
            'orders' => $orders
        ])->layout('layouts.app');
    }
}
