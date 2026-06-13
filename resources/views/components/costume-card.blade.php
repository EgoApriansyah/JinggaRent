@props(['costume'])

<a href="/katalog/{{ $costume->slug }}" class="flex flex-col h-full bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 hover:border-transparent transition-all duration-300 group">
    <div class="relative pt-[120%] bg-gray-100 overflow-hidden">
        @if($costume->images->count() > 0)
            <img src="{{ Storage::url($costume->images->where('is_primary', true)->first()?->image_path ?? $costume->images->first()->image_path) }}" 
                 alt="{{ $costume->name }}" 
                 class="absolute top-0 left-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-gray-400 font-medium">
                No Image
            </div>
        @endif
        
        <div class="absolute top-3 right-3">
            <x-status-badge :status="$costume->status" />
        </div>
    </div>
    
    <div class="p-5 flex flex-col flex-grow">
        <div class="text-sm text-primary font-semibold mb-1 uppercase tracking-wide">
            {{ $costume->region->name ?? 'Regional' }}
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">
            {{ $costume->name }}
        </h3>
        
        <div class="flex items-center gap-1.5 mb-4 mt-auto">
            <x-star-rating :rating="$costume->averageRating" />
            <span class="text-sm text-gray-500">
                ({{ $costume->reviews->count() }} ulasan)
            </span>
        </div>
        
        <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <div>
                <span class="text-xl font-bold text-gray-900">
                    Rp {{ number_format($costume->price_per_day, 0, ',', '.') }}
                </span>
                <span class="text-sm text-gray-500">/hari</span>
            </div>
        </div>
    </div>
</a>
