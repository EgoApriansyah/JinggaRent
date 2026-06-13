<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Pesanan Saya</h1>
            <p class="text-gray-500 mt-1">Riwayat sewa baju adat Anda</p>
        </div>
        <a href="/katalog" class="px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-hover shadow-sm text-sm transition-colors">Sewa Lagi</a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
        @if($orders->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($orders as $order)
                    <li>
                        <a href="/pesanan/{{ $order->id }}" class="block hover:bg-gray-50 transition duration-150 ease-in-out">
                            <div class="px-4 py-6 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                            @if($order->costume->images->count() > 0)
                                                <img class="h-16 w-16 object-cover" src="{{ asset('storage/' . $order->costume->images->first()->image_path) }}" alt="">
                                            @else
                                                <div class="h-16 w-16 flex items-center justify-center text-xs text-gray-400">No Img</div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-lg font-bold text-primary truncate">
                                                {{ $order->costume->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 mt-1">
                                                Kode: <span class="font-mono text-gray-900">{{ $order->order_code }}</span> • {{ $order->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <div class="mb-2">
                                            <x-status-badge :status="$order->status" />
                                        </div>
                                        <div class="text-sm font-semibold text-gray-900">
                                            Total: Rp {{ number_format($order->total_payment, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center text-sm text-gray-500">
                                            Tanggal Sewa: <span class="text-gray-900 font-medium ml-1">{{ \Carbon\Carbon::parse($order->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($order->end_date)->format('d M Y') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 text-2xl">
                    📦
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada pesanan</h3>
                <p class="mt-1 text-gray-500">Anda belum pernah menyewa baju adat.</p>
                <div class="mt-6">
                    <a href="/katalog" class="px-6 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-hover transition-colors">Lihat Katalog</a>
                </div>
            </div>
        @endif
    </div>
</div>
