<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Profile Header Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Cover Image & Avatar -->
        <div class="h-32 sm:h-48 w-full bg-gradient-to-r from-primary to-primary-hover relative">
            <div class="absolute -bottom-12 sm:-bottom-16 left-8">
                <div class="w-24 h-24 sm:w-32 sm:h-32 bg-white rounded-full p-1.5 shadow-lg">
                    <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center text-3xl sm:text-5xl font-bold text-primary uppercase">
                        {{ substr($name, 0, 1) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Info -->
        <div class="pt-16 sm:pt-20 px-8 pb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 pb-6 mb-6">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900">{{ $name }}</h1>
                    <p class="text-gray-500 font-medium mt-1">Anggota Jingga Rent</p>
                </div>
                <a href="{{ route('member.profile.edit') }}" class="inline-flex items-center justify-center py-2.5 px-6 border border-transparent shadow-md text-sm font-bold rounded-xl text-white bg-primary hover:bg-primary-hover hover:-translate-y-0.5 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Ubah Profil
                </a>
            </div>

            @if (session()->has('message'))
                <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl mb-6 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Contact Info -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Informasi Kontak
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <div class="mb-4">
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat Email</span>
                            <span class="text-base font-semibold text-gray-900">{{ $email }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nomor Telepon</span>
                            <span class="text-base font-semibold text-gray-900">{{ $phone ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Address Info -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lokasi Pengiriman
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 h-[116px]">
                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat Lengkap</span>
                        <p class="text-base font-semibold text-gray-900 line-clamp-3">{{ $address ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
