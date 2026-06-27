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
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            {{ session('error') }}
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
                    <p class="text-sm text-gray-900 bg-gray-50 p-4 rounded-xl border border-gray-100">{{ $order->customer_notes ?? 'Tidak ada catatan.' }}</p>
                    
                    <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mt-6 mb-4">Informasi Pengambilan</h4>
                    <div class="bg-primary/5 border border-primary/20 rounded-xl p-4">
                        <p class="text-sm text-gray-800">Silakan lakukan pengambilan baju adat di alamat toko <strong>Jingga Rent</strong>:</p>
                        <p class="text-sm text-gray-900 font-semibold mt-1">Jl. Srimenanti No. 123, Pangkalpinang, Bangka Belitung</p>
                    </div>
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
                <div class="mt-4 flex flex-col sm:flex-row justify-between items-center border-t border-gray-100 pt-6 gap-4">
                    <button wire:click="cancelOrder" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="w-full sm:w-auto text-sm text-red-600 hover:text-red-800 font-medium px-6 py-4 border border-red-200 rounded-xl hover:bg-red-50 transition-colors">
                        Batalkan Pesanan
                    </button>
                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <button wire:click="checkPaymentStatus" class="w-full sm:w-auto px-6 py-4 bg-white text-gray-700 border border-gray-300 rounded-xl font-bold hover:bg-gray-50 hover:-translate-y-1 shadow-sm transition-all duration-300">
                            <span wire:loading.remove wire:target="checkPaymentStatus">Cek Status Bayar</span>
                            <span wire:loading wire:target="checkPaymentStatus">Mengecek...</span>
                        </button>
                        <button wire:click="pay" class="w-full sm:w-auto px-8 py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-hover hover:-translate-y-1 shadow-lg transition-all duration-300">
                            Bayar Sekarang (QRIS)
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


