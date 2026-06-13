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
            <div class="w-full md:w-1/2 bg-gray-100 relative flex flex-col" x-data="{ mainImage: '{{ $costume->images->count() > 0 ? Storage::url($costume->images->where('is_primary', true)->first()?->image_path ?? $costume->images->first()->image_path) : '' }}' }">
                <div class="relative w-full aspect-[4/5] md:aspect-auto md:flex-1">
                    @if($costume->images->count() > 0)
                        <img :src="mainImage" 
                             alt="{{ $costume->name }}" 
                             class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="w-full h-full aspect-[4/5] flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <x-status-badge :status="$costume->status" />
                    </div>
                </div>
                
                @if($costume->images->count() > 1)
                <div class="flex gap-2 p-4 bg-white overflow-x-auto">
                    @foreach($costume->images as $image)
                        <img src="{{ Storage::url($image->image_path) }}" 
                             class="w-20 h-20 object-cover rounded-lg cursor-pointer border-2 hover:border-primary transition-colors"
                             x-on:click="mainImage = '{{ Storage::url($image->image_path) }}'">
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- Details & Checkout -->
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col">
                <div class="mb-2 flex items-center gap-2">
                    @if($costume->category && $costume->category->icon)
                        <img src="{{ Storage::url($costume->category->icon) }}" class="w-6 h-6 object-contain" alt="{{ $costume->category->name }}">
                    @endif
                    <span class="text-primary font-bold tracking-wide uppercase text-sm">
                        {{ $costume->category->name ?? 'Kategori' }} &bull; {{ $costume->region->name ?? 'Regional' }}
                    </span>
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
                        
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kuantitas</label>
                            <div class="inline-flex items-center border border-gray-300 rounded-lg h-10 overflow-hidden bg-white">
                                <button type="button" wire:click="$set('quantity', quantity > 1 ? quantity - 1 : 1)" class="px-4 text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors h-full flex items-center justify-center font-medium text-lg focus:outline-none">&minus;</button>
                                <div class="w-12 text-center text-primary font-bold border-l border-r border-gray-300 h-full flex items-center justify-center">
                                    {{ $quantity }}
                                </div>
                                <button type="button" wire:click="$set('quantity', quantity < {{ $costume->stock }} ? quantity + 1 : {{ $costume->stock }})" class="px-4 text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors h-full flex items-center justify-center font-medium text-lg focus:outline-none">&plus;</button>
                            </div>
                            <span class="text-xs text-gray-500 mt-2 block">Tersedia: {{ $costume->stock }} buah</span>
                            @error('quantity') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        @if($days > 0 && $quantity > 0)
                            <div class="space-y-2 mb-6 pt-4 border-t border-gray-200">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>{{ $quantity }} Pakaian x {{ $days }} hari x Rp {{ number_format($costume->price_per_day, 0, ',', '.') }}</span>
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
                        
                        @if($days <= 0)
                            <div class="text-sm text-red-500 mb-2 text-center">Silakan lengkapi tanggal mulai dan selesai terlebih dahulu.</div>
                        @endif
                        
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan untuk Penjual (Opsional)</label>
                            <textarea wire:model="customer_notes" rows="2" placeholder="Contoh: Tolong disiapkan ya, saya akan ambil jam 10 pagi." class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary text-sm"></textarea>
                        </div>
                        
                        <button wire:click="checkout" class="w-full py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-hover hover:-translate-y-1 shadow-lg transition-all duration-300" {{ $days <= 0 ? 'disabled' : '' }} style="{{ $days <= 0 ? 'opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none;' : '' }}">
                            Lanjut ke Pembayaran
                        </button>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- Reviews Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b border-gray-200 pb-2">Ulasan Pelanggan</h2>
        
        @if($costume->reviews->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($costume->reviews as $review)
                    @if($review->is_approved)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-lg">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $review->user->name }}</h4>
                                <div class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <x-star-rating :rating="$review->rating" />
                        </div>
                        <p class="text-gray-600 text-sm italic">"{{ $review->comment }}"</p>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="bg-white p-8 rounded-2xl border border-gray-100 text-center">
                <div class="text-gray-400 mb-2">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada ulasan</h3>
                <p class="text-gray-500 mt-1">Jadilah yang pertama memberikan ulasan setelah menyewa pakaian ini!</p>
            </div>
        @endif
    </div>
</div>
