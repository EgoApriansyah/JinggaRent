<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Profil Saya</h3>
            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi akun dan alamat pengiriman Anda di sini.
            </p>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="bg-white shadow sm:rounded-lg">
                <form wire:submit.prevent="updateProfile">
                    <div class="px-4 py-5 sm:p-6 space-y-6">
                        @if (session()->has('message'))
                            <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input wire:model="name" id="name" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary">
                            @error('name') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input wire:model="email" id="email" type="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary">
                            @error('email') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input wire:model="phone" id="phone" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary">
                            @error('phone') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea wire:model="address" id="address" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary"></textarea>
                            @error('address') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-b-lg border-t border-gray-200">
                        <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
