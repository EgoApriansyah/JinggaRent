<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Costume;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CostumeDetail extends Component
{
    public $costume;
    public $start_date;
    public $end_date;
    public $quantity = 1;
    public $customer_notes;
    public $days = 0;
    public $subtotal = 0;
    public $deposit = 0;
    public $total = 0;

    public function mount($slug)
    {
        $this->costume = Costume::where('slug', $slug)->with(['region', 'category', 'images', 'reviews.user'])->firstOrFail();
    }

    public function updatedStartDate()
    {
        $this->calculateTotal();
    }

    public function updatedEndDate()
    {
        $this->calculateTotal();
    }

    public function updatedQuantity()
    {
        if ($this->quantity < 1) {
            $this->quantity = 1;
        }
        if ($this->quantity > $this->costume->stock) {
            $this->quantity = $this->costume->stock;
        }
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        if ($this->start_date && $this->end_date) {
            $start = Carbon::parse($this->start_date);
            $end = Carbon::parse($this->end_date);
            
            if ($end->greaterThanOrEqualTo($start)) {
                $this->days = $start->diffInDays($end) + 1; // Inclusive
                $this->subtotal = $this->days * $this->costume->price_per_day * $this->quantity;
                $this->deposit = $this->subtotal * 0.5; // 50% deposit
                $this->total = $this->subtotal + $this->deposit;
            } else {
                $this->days = 0;
                $this->subtotal = 0;
                $this->deposit = 0;
                $this->total = 0;
            }
        }
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'quantity' => 'required|integer|min:1|max:' . $this->costume->stock,
        ]);

        // Create Order
        $order = Order::create([
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'costume_id' => $this->costume->id,
            'quantity' => $this->quantity,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'rental_days' => $this->days,
            'price_per_day' => $this->costume->price_per_day,
            'subtotal' => $this->subtotal,
            'deposit_amount' => $this->deposit,
            'total_payment' => $this->total,
            'status' => 'menunggu',
            'customer_notes' => $this->customer_notes,
        ]);

        // Send notifications
        Auth::user()->notify(new \App\Notifications\PaymentPendingNotification($order));
        
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\NewOrderAdminNotification($order));
        }

        return redirect()->route('member.order.detail', ['id' => $order->id]);
    }

    public function render()
    {
        return view('livewire.costume-detail')->layout('layouts.app');
    }
}
