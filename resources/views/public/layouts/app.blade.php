{{-- Layout utama publik --}}
<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jarreva Creative')</title>
    
    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-white dark:bg-background-dark text-text-main dark:text-white antialiased overflow-x-hidden">
    <div class="flex min-h-screen w-full flex-col">
        @include('public.components.navbar')
        
        <main class="flex-grow pt-24">
            @yield('content')
        </main>
        
        @include('public.components.footer')
    </div>
    
    @stack('scripts')
</body>
</html>
