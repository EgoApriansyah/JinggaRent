@props(['status'])

@php
    $class = match($status) {
        'menunggu', 'pending' => 'bg-amber-100 text-amber-800 border border-amber-200',
        'dikonfirmasi', 'dibayar', 'sukses' => 'bg-blue-100 text-blue-800 border border-blue-200',
        'aktif' => 'bg-primary/10 text-primary-hover border border-primary/20',
        'dikembalikan', 'selesai', 'refunded' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
        'ditolak', 'dibatalkan', 'gagal', 'expired' => 'bg-rose-100 text-rose-800 border border-rose-200',
        default => 'bg-gray-100 text-gray-800 border border-gray-200',
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $class }}">
    {{ ucfirst($status) }}
</span>
