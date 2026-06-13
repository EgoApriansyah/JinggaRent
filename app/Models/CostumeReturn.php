<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'order_id', 'processed_by', 'return_date', 'condition',
    'damage_notes', 'damage_photos', 'deposit_returned', 'refund_transaction_id'
])]
class CostumeReturn extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'return_date' => 'date',
            'damage_photos' => 'array',
            'deposit_returned' => 'boolean',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
