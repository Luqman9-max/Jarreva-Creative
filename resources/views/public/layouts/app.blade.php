{{-- Layout utama publik --}}
<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jarreva Creative')</title>
    <meta name="color-scheme" content="light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- SEO Meta Tags --}}
    <meta name="description" content="@yield('meta_description', 'Jarreva Creative — Creative publishing studio delivering transformative books and digital content that inspire growth and innovation.')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- Open Graph / Social --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Jarreva Creative')">
    <meta property="og:description" content="@yield('meta_description', 'Jarreva Creative — Creative publishing studio delivering transformative books and digital content.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('logo.webp') }}">
    <meta property="og:site_name" content="Jarreva Creative">
    
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Jarreva Creative')">
    <meta name="twitter:description" content="@yield('meta_description', 'Jarreva Creative — Creative publishing studio delivering transformative books and digital content.')">
    <meta name="twitter:image" content="{{ asset('logo.webp') }}">
    
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Three.js Library (3D components handle adaptive quality via JarrevaPerf) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js" defer></script>
    
    @stack('styles')
</head>
<body class="bg-white dark:bg-background-dark text-text-main dark:text-white antialiased overflow-x-hidden">
    <div class="flex min-h-screen w-full flex-col">
        @include ('public.components.navbar')
        
        <main class="flex-grow pt-24">
            @yield('content')
        </main>
        
        @include ('public.components.footer')
    </div>
    
    @stack('scripts')
</body>
</html>

