<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class IncomingOrders extends Component
{
    use WithPagination;

    public function mount()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    public function render()
    {
        $orders = Order::with(['user', 'costume'])
            ->latest()
            ->paginate(15);

        return view('livewire.admin.incoming-orders', [
            'orders' => $orders
        ])->layout('layouts.app');
    }
}
