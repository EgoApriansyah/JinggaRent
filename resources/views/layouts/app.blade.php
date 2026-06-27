<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'JinggaRent') | Sewa Baju Adat Premium</title>
    
    <meta name="description" content="JinggaRent menyediakan layanan sewa baju adat premium dari seluruh Indonesia. Kualitas terbaik, nyaman dipakai, dan proses sewa yang mudah.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#D97706',
                            hover: '#B45309',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased flex flex-col min-h-screen">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="/" class="text-2xl font-bold text-primary tracking-tight">JinggaRent</a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 font-medium hover:text-primary transition-colors duration-150">Beranda</a>
                    <a href="/katalog" class="text-gray-600 font-medium hover:text-primary transition-colors duration-150">Katalog</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin" class="text-gray-600 font-medium hover:text-primary transition-colors duration-150">Dashboard Admin</a>
                        @endif
                        @if(Auth::user()->role === 'admin')
                            <a href="/pesanan-masuk" class="text-gray-600 font-medium hover:text-primary transition-colors duration-150">Pesanan Masuk</a>
                        @else
                            <a href="/pesanan" class="text-gray-600 font-medium hover:text-primary transition-colors duration-150">Pesanan Saya</a>
                        @endif
                        <a href="/profil" class="text-gray-600 font-medium hover:text-primary transition-colors duration-150">Profil</a>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 border border-gray-200 text-gray-900 rounded-lg font-semibold hover:border-primary hover:text-primary transition-all duration-300">Keluar</button>
                        </form>
                    @else
                        <a href="/masuk" class="px-4 py-2 border border-gray-200 text-gray-900 rounded-lg font-semibold hover:border-primary hover:text-primary transition-all duration-300">Masuk</a>
                        <a href="/daftar" class="px-6 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-hover hover:-translate-y-0.5 shadow-md transition-all duration-300">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <footer class="bg-white border-t border-gray-200 mt-16 py-12 text-gray-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-6 md:mb-0 text-center md:text-left">
                <h3 class="text-gray-900 text-xl font-bold mb-2">JinggaRent</h3>
                <p>Sewa baju adat premium dengan mudah dan aman.</p>
            </div>
            <div class="flex space-x-8">
                <a href="/tentang" class="hover:text-primary transition-colors duration-150">Tentang Kami</a>
                <a href="/kontak" class="hover:text-primary transition-colors duration-150">Hubungi Kami</a>
                <a href="/faq" class="hover:text-primary transition-colors duration-150">FAQ</a>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-8 border-t border-gray-200 text-center text-sm">
            &copy; {{ date('Y') }} JinggaRent. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>
</html>
