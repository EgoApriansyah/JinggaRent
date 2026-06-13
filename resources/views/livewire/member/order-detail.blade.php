<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex mb-8 text-sm text-gray-500 font-medium">
        <a href="/pesanan" class="hover:text-primary transition-colors">Pesanan Saya</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Detail Pesanan #{{ $order->order_code }}</span>
    </nav>

    @if (session()->has('info'))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl">
            {{ session('info') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Pesanan #{{ $order->order_code }}</h3>
                <p class="text-sm text-gray-500 mt-1">Dibuat pada {{ $order->created_at->format('d F Y H:i') }}</p>
            </div>
            <div>
                <x-status-badge :status="$order->status" />
            </div>
        </div>
        
        <div class="px-6 py-6 sm:px-8">
            <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">Item yang disewa</h4>
            <div class="flex items-center gap-6 pb-6 border-b border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-xl overflow-hidden border border-gray-200 flex-shrink-0">
                    @if($order->costume->images->count() > 0)
                        <img src="{{ asset('storage/' . $order->costume->images->first()->image_path) }}" alt="" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">No Image</div>
                    @endif
                </div>
                <div>
                    <div class="text-primary font-bold text-sm mb-1">{{ $order->costume->region->name ?? 'Regional' }}</div>
                    <h3 class="text-xl font-extrabold text-gray-900">{{ $order->costume->name }}</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Disewa selama {{ \Carbon\Carbon::parse($order->start_date)->diffInDays(\Carbon\Carbon::parse($order->end_date)) + 1 }} hari
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-6 border-b border-gray-100">
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">Informasi Jadwal</h4>
                    <div class="space-y-3">
                        <div>
                            <span class="block text-sm text-gray-500">Tanggal Pengambilan</span>
                            <span class="block font-medium text-gray-900">{{ \Carbon\Carbon::parse($order->start_date)->format('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-500">Tanggal Pengembalian</span>
                            <span class="block font-medium text-gray-900">{{ \Carbon\Carbon::parse($order->end_date)->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">Catatan</h4>
                    <p class="text-sm text-gray-900 bg-gray-50 p-4 rounded-xl border border-gray-100">{{ $order->notes ?? 'Tidak ada catatan.' }}</p>
                </div>
            </div>

            <div class="py-6">
                <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">Rincian Pembayaran</h4>
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="space-y-3 mb-4 pb-4 border-b border-gray-200 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal Sewa</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($order->total_payment - $order->deposit_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Deposit (50%)</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($order->deposit_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center text-lg font-bold text-gray-900">
                        <span>Total Keseluruhan</span>
                        <span class="text-primary text-xl">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
            @if($order->status === 'menunggu')
                <div class="mt-4 flex justify-end">
                    <button wire:click="pay" class="px-8 py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-hover hover:-translate-y-1 shadow-lg transition-all duration-300">
                        Bayar Sekarang (Midtrans)
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

@script
<script>
    $wire.on('snap-pay', ({ token }) => {
        snap.pay(token, {
            onSuccess: function(result){
                window.location.reload();
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda!");
            },
            onError: function(result){
                alert("Pembayaran gagal!");
            },
            onClose: function(){
                // Popup closed
            }
        });
    });
</script>
@endscript
