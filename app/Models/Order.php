<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'order_code', 'user_id', 'costume_id', 'start_date', 'end_date', 
    'rental_days', 'price_per_day', 'subtotal', 'deposit_amount', 
    'total_payment', 'status', 'admin_notes'
])]
class Order extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'price_per_day' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'deposit_amount' => 'decimal:2',
            'total_payment' => 'decimal:2',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            if (!$order->order_code) {
                $order->order_code = 'JR-' . now()->format('Ymd') . '-' . strtoupper(uniqid());
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function costume(): BelongsTo
    {
        return $this->belongsTo(Costume::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function costumeReturn(): HasOne
    {
        return $this->hasOne(CostumeReturn::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
