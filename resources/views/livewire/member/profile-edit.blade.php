<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex mb-8 text-sm text-gray-500 font-medium">
        <a href="{{ route('member.profile') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Profil
        </a>
    </nav>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-2xl font-extrabold text-gray-900">Ubah Profil</h3>
            <p class="mt-1 text-sm font-medium text-gray-500">
                Perbarui informasi akun Anda dengan teliti agar tidak terjadi kesalahan pengiriman pesanan.
            </p>
        </div>
        
        <form wire:submit.prevent="updateProfile">
            <div class="px-8 py-8 space-y-6">
                @if (session()->has('message'))
                    <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('message') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input wire:model="name" id="name" type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all shadow-sm">
                        @error('name') <span class="text-sm text-red-500 mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                        <input wire:model="phone" id="phone" type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all shadow-sm">
                        @error('phone') <span class="text-sm text-red-500 mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input wire:model="email" id="email" type="email" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all shadow-sm">
                    @error('email') <span class="text-sm text-red-500 mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea wire:model="address" id="address" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all shadow-sm"></textarea>
                    <p class="text-xs text-gray-500 mt-2">Alamat ini akan digunakan sebagai patokan untuk pemesanan/pengembalian.</p>
                    @error('address') <span class="text-sm text-red-500 mt-1 font-medium">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('member.profile') }}" class="inline-flex justify-center items-center py-3 px-6 border-2 border-gray-200 shadow-sm text-sm font-bold rounded-xl text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 transition-all focus:outline-none">
                    Batal
                </a>
                <button type="submit" class="inline-flex justify-center items-center py-3 px-6 border border-transparent shadow-md text-sm font-bold rounded-xl text-white bg-primary hover:bg-primary-hover hover:-translate-y-0.5 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
