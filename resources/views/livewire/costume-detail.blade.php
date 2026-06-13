<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm text-gray-500 font-medium">
            <a href="/" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-2">/</span>
            <a href="/katalog" class="hover:text-primary transition-colors">Katalog</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $costume->name }}</span>
        </nav>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden flex flex-col md:flex-row">
            
            <!-- Image Gallery -->
            <div class="w-full md:w-1/2 bg-gray-100 relative">
                @if($costume->images->count() > 0)
                    <img src="{{ Storage::url($costume->images->where('is_primary', true)->first()?->image_path ?? $costume->images->first()->image_path) }}" 
                         alt="{{ $costume->name }}" 
                         class="w-full h-full object-cover aspect-[4/5] md:aspect-auto md:absolute md:inset-0">
                @else
                    <div class="w-full h-full aspect-[4/5] flex items-center justify-center text-gray-400">
                        No Image
                    </div>
                @endif
                <div class="absolute top-4 left-4">
                    <x-status-badge :status="$costume->status" />
                </div>
            </div>
            
            <!-- Details & Checkout -->
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col">
                <div class="mb-2 text-primary font-bold tracking-wide uppercase text-sm">
                    {{ $costume->region->name ?? 'Regional' }}
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                    {{ $costume->name }}
                </h1>
                
                <div class="flex items-center gap-2 mb-6">
                    <x-star-rating :rating="$costume->averageRating" />
                    <span class="text-gray-500 text-sm">({{ $costume->reviews->count() }} ulasan)</span>
                </div>
                
                <div class="text-2xl font-bold text-gray-900 mb-6 pb-6 border-b border-gray-100">
                    Rp {{ number_format($costume->price_per_day, 0, ',', '.') }} <span class="text-base font-normal text-gray-500">/hari</span>
                </div>
                
                <div class="prose text-gray-600 mb-8 max-w-none">
                    <p>{{ $costume->description }}</p>
                </div>
                
                <!-- Booking Form -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mt-auto">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Mulai Sewa</h3>
                    
                    @if($costume->status !== 'tersedia')
                        <div class="p-4 bg-red-50 text-red-700 rounded-xl mb-4 border border-red-100">
                            Maaf, baju adat ini sedang {{ $costume->status === 'disewa' ? 'disewa oleh pelanggan lain' : 'dalam perawatan' }}.
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai</label>
                                <input type="date" wire:model.live="start_date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary">
                                @error('start_date') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
                                <input type="date" wire:model.live="end_date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary">
                                @error('end_date') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        @if($days > 0)
                            <div class="space-y-2 mb-6 pt-4 border-t border-gray-200">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Sewa {{ $days }} hari x Rp {{ number_format($costume->price_per_day, 0, ',', '.') }}</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Deposit (50%) <i class="text-xs text-gray-400">*dikembalikan setelah selesai</i></span>
                                    <span>Rp {{ number_format($deposit, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold text-gray-900 pt-2 border-t border-gray-200">
                                    <span>Total Pembayaran</span>
                                    <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endif
                        
                        <button wire:click="checkout" class="w-full py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-hover hover:-translate-y-1 shadow-lg transition-all duration-300" {{ $days <= 0 ? 'disabled' : '' }} style="{{ $days <= 0 ? 'opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none;' : '' }}">
                            Lanjut ke Pembayaran
                        </button>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
