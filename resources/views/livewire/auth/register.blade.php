<div>
    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Buat Akun Baru</h2>
    
    <form wire:submit.prevent="register" class="space-y-5">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input wire:model="name" id="name" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror" placeholder="Nama lengkap Anda" required autofocus>
            @error('name') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
            <input wire:model="email" id="email" type="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror" placeholder="nama@email.com" required>
            @error('email') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon/WhatsApp</label>
            <input wire:model="phone" id="phone" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary @error('phone') border-red-500 @enderror" placeholder="081234567890" required>
            @error('phone') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
            <textarea wire:model="address" id="address" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary @error('address') border-red-500 @enderror" placeholder="Alamat lengkap untuk pengiriman/pengambilan" required></textarea>
            @error('address') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                <input wire:model="password" id="password" type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary @error('password') border-red-500 @enderror" placeholder="Minimal 8 karakter" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <input wire:model="password_confirmation" id="password_confirmation" type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary" placeholder="Ulangi kata sandi" required>
            </div>
        </div>
        @error('password') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                <span wire:loading wire:target="register">Memproses...</span>
            </button>
        </div>
    </form>
    
    <div class="mt-6 text-center text-sm text-gray-600">
        Sudah punya akun? 
        <a href="/masuk" class="font-semibold text-primary hover:text-primary-hover transition-colors duration-200">Masuk di sini</a>
    </div>
</div>
