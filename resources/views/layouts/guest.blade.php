<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'JinggaRent Auth') | JinggaRent</title>
    
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
</head>
<body class="bg-gray-50 font-sans antialiased flex flex-col items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="/" class="text-3xl font-bold text-primary tracking-tight">JinggaRent</a>
        </div>
        
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
            @yield('content')
            {{ $slot ?? '' }}
        </div>
        
        <div class="text-center mt-6 text-gray-500 text-sm">
            &copy; {{ date('Y') }} JinggaRent. All rights reserved.
        </div>
    </div>

</body>
</html>
