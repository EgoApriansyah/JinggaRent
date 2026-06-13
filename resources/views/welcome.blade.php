@extends('layouts.app')

@section('content')
<section class="py-16 md:py-24 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6 tracking-tight">
                Tampil Memukau dengan <span class="text-primary">Baju Adat</span> Nusantara
            </h1>
            <p class="text-lg md:text-xl text-gray-500 mb-8 max-w-lg">
                Temukan koleksi baju adat premium dari seluruh Indonesia untuk momen spesial Anda. Kualitas terjamin, harga terjangkau, dan proses sewa yang praktis.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/katalog" class="px-8 py-4 bg-primary text-white rounded-lg font-semibold hover:bg-primary-hover hover:-translate-y-0.5 shadow-md transition-all duration-300 text-center">Lihat Koleksi</a>
                <a href="/tentang" class="px-8 py-4 border border-gray-200 text-gray-900 rounded-lg font-semibold hover:border-primary hover:text-primary transition-all duration-300 text-center">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="relative mt-8 md:mt-0">
            <div class="aspect-[4/5] bg-gray-200 rounded-3xl overflow-hidden relative transform rotate-2 hover:rotate-0 transition-transform duration-500 shadow-xl">
                <!-- Placeholder for Hero Image -->
                <div class="w-full h-full flex items-center justify-center text-gray-500 font-medium">
                   <img src="{{ asset('assets/hero.jpg') }}" alt="Logo">
                </div>
            </div>
            <!-- Decorative element -->
            <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-800 font-bold text-xl">
                    ✓
                </div>
                <div>
                    <div class="font-bold text-gray-900">Kualitas Premium</div>
                    <div class="text-sm text-gray-500">Terjamin kebersihannya</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Koleksi Populer</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg">Pilihan baju adat favorit yang sering disewa oleh pelanggan kami untuk berbagai acara penting.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- These will be replaced by actual data in controller -->
            @foreach(\App\Models\Costume::with(['region', 'images'])->limit(4)->get() as $costume)
                <x-costume-card :costume="$costume" />
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="/katalog" class="inline-block px-8 py-3 border border-gray-200 text-gray-900 rounded-lg font-semibold hover:border-primary hover:text-primary transition-all duration-300">Lihat Semua Koleksi</a>
        </div>
    </div>
</section>
@endsection
