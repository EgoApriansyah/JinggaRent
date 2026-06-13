<div>
    <div class="bg-primary/10 py-12 border-b border-primary/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-4">Katalog Baju Adat</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Temukan koleksi baju adat dari seluruh pelosok Nusantara. Gunakan filter untuk memudahkan pencarian Anda.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row gap-8">
            
            <!-- Sidebar / Filters -->
            <div class="w-full md:w-64 flex-shrink-0">
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 border-b border-gray-100 pb-2">Filter Pencarian</h3>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Nama</label>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari baju adat..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select wire:model.live="selectedCategory" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Asal Daerah</label>
                        <select wire:model.live="selectedRegion" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary bg-white">
                            <option value="">Semua Daerah</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Urutkan Berdasarkan</label>
                        <select wire:model.live="sort" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary bg-white">
                            <option value="latest">Terbaru</option>
                            <option value="price_asc">Harga Terendah</option>
                            <option value="price_desc">Harga Tertinggi</option>
                        </select>
                    </div>
                    
                    <button wire:click="$set('search', ''); $set('selectedCategory', ''); $set('selectedRegion', ''); $set('sort', 'latest');" class="mt-6 w-full py-2 text-sm text-gray-500 hover:text-primary transition-colors duration-200">
                        Reset Filter
                    </button>
                </div>
            </div>
            
            <!-- Main Content Grid -->
            <div class="flex-grow">
                <div class="mb-6 flex justify-between items-center">
                    <p class="text-gray-500">Menampilkan <span class="font-bold text-gray-900">{{ $costumes->total() }}</span> hasil.</p>
                    <!-- Loading indicator -->
                    <div wire:loading class="text-primary font-medium text-sm flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memuat...
                    </div>
                </div>

                @if($costumes->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($costumes as $costume)
                            <x-costume-card :costume="$costume" />
                        @endforeach
                    </div>
                    
                    <div class="mt-12">
                        {{ $costumes->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                            🔍
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pakaian tidak ditemukan</h3>
                        <p class="text-gray-500 mb-6">Coba ubah filter pencarian Anda untuk melihat lebih banyak hasil.</p>
                        <button wire:click="$set('search', ''); $set('selectedCategory', ''); $set('selectedRegion', ''); $set('sort', 'latest');" class="px-6 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-hover transition-colors duration-200">
                            Hapus Semua Filter
                        </button>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
