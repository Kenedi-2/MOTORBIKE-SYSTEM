<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css','resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex flex-col">

<!-- 🔄 Loading Spinner -->
<div id="loading-spinner"
     class="fixed inset-0 bg-white/80 backdrop-blur-sm z-[100] flex items-center justify-center opacity-0 pointer-events-none transition">
    <div class="w-12 h-12 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
</div>

<div class="min-h-screen flex flex-col">

    <!-- 🔝 NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b shadow-sm">
        @include('layouts.navigation')
    </header>

    <!-- 🧾 HEADER -->
    @isset($header)
    <header class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">
                {{ $header }}
            </h1>

            @isset($headerActions)
            <div>{{ $headerActions }}</div>
            @endisset
        </div>
    </header>
    @endisset

    <!-- 🔔 FLASH MESSAGES -->
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @foreach (['success','error','warning','info'] as $msg)
            @if(session($msg))
                <div class="flex items-center p-4 mb-4 rounded border-l-4
                    {{ $msg === 'success' ? 'bg-green-50 border-green-500 text-green-700' : '' }}
                    {{ $msg === 'error' ? 'bg-red-50 border-red-500 text-red-700' : '' }}
                    {{ $msg === 'warning' ? 'bg-yellow-50 border-yellow-500 text-yellow-700' : '' }}
                    {{ $msg === 'info' ? 'bg-blue-50 border-blue-500 text-blue-700' : '' }}">
                    
                    <i class="fa-solid mr-3
                        {{ $msg === 'success' ? 'fa-check-circle' : '' }}
                        {{ $msg === 'error' ? 'fa-times-circle' : '' }}
                        {{ $msg === 'warning' ? 'fa-exclamation-triangle' : '' }}
                        {{ $msg === 'info' ? 'fa-info-circle' : '' }}"></i>

                    {{ session($msg) }}

                    <button onclick="this.parentElement.remove()" class="ml-auto">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            @endif
        @endforeach
    </div>

    <!-- 📦 MAIN -->
    <main class="flex-1">
        <div class="py-6 max-w-7xl mx-auto px-4">
            {{ $slot }}
        </div>
    </main>

    <!-- 🔻 FOOTER -->
    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between text-sm text-gray-500">
            <div>&copy; {{ date('Y') }} {{ config('app.name') }}</div>
            <div class="space-x-4">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
        </div>
    </footer>

</div>

<!-- ⚡ QUICK ACTION BUTTON -->
@auth
<div class="fixed bottom-6 right-6 z-50 flex flex-col items-end space-y-2">

    <!-- MENU -->
    <div id="quickActions" class="hidden space-y-2">

        @if(auth()->user()->role === 'admin')
        <button onclick="location.href='{{ route('dashboard') }}'"
            class="px-4 py-2 bg-white rounded shadow hover:scale-105 transition">
            Dashboard
        </button>
        @endif

        @if(auth()->user()->role === 'driver')
        <button onclick="location.href='{{ route('drivers.dashboard') }}'"
            class="px-4 py-2 bg-white rounded shadow hover:scale-105 transition">
            Dashboard
        </button>

        <button onclick="location.href='{{ route('drivers.contracts') }}'"
            class="px-4 py-2 bg-white rounded shadow hover:scale-105 transition">
            My Contract
        </button>
        @endif

        <button onclick="location.href='{{ route('profile.edit') }}'"
            class="px-4 py-2 bg-white rounded shadow hover:scale-105 transition">
            Profile
        </button>

    </div>

    <!-- BUTTON -->
    <button onclick="document.getElementById('quickActions').classList.toggle('hidden')"
        class="w-12 h-12 bg-blue-600 text-white rounded-full shadow-lg hover:scale-110 transition">
        +
    </button>

</div>
@endauth

<!-- ⬆ BACK TO TOP -->
<button id="backToTop"
    class="fixed bottom-6 left-6 w-10 h-10 bg-gray-800 text-white rounded-full opacity-0 invisible transition"
    onclick="window.scrollTo({top:0,behavior:'smooth'})">
    ↑
</button>

<!-- 🧠 SCRIPTS -->
@stack('scripts')

<script>
// 🔄 Spinner
document.querySelectorAll('a, button[type="submit"]').forEach(el => {
    el.addEventListener('click', () => {
        document.getElementById('loading-spinner')
            .classList.remove('opacity-0','pointer-events-none');
    });
});

// ⬆ Back to top
window.addEventListener('scroll', function () {
    let btn = document.getElementById('backToTop');
    if (window.scrollY > 300) {
        btn.classList.remove('opacity-0','invisible');
    } else {
        btn.classList.add('opacity-0','invisible');
    }
});
</script>

</body>
</html>