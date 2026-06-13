<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'order_id', 'midtrans_transaction_id', 'midtrans_order_id', 'payment_type',
    'gross_amount', 'status', 'snap_token', 'snap_url', 'midtrans_response',
    'paid_at', 'expired_at'
])]
class Payment extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'gross_amount' => 'decimal:2',
            'midtrans_response' => 'array',
            'paid_at' => 'datetime',
            'expired_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
