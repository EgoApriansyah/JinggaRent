<div>
    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Masuk ke Akun Anda</h2>
    
    <form wire:submit.prevent="login" class="space-y-5">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
            <input wire:model="email" id="email" type="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror" placeholder="nama@email.com" required autofocus>
            @error('email') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
            <input wire:model="password" id="password" type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary @error('password') border-red-500 @enderror" placeholder="••••••••" required>
            @error('password') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input wire:model="remember" id="remember_me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    Ingat saya
                </label>
            </div>

            <div class="text-sm">
                <a href="#" class="font-medium text-primary hover:text-primary-hover">Lupa kata sandi?</a>
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="login">Masuk</span>
                <span wire:loading wire:target="login">Memproses...</span>
            </button>
        </div>
    </form>
    
    <div class="mt-6 text-center text-sm text-gray-600">
        Belum punya akun? 
        <a href="/daftar" class="font-semibold text-primary hover:text-primary-hover transition-colors duration-200">Daftar sekarang</a>
    </div>
</div>
