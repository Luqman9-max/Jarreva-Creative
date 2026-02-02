{{-- Layout admin --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Jarreva Creative')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="admin-wrapper">
        @include('admin.components.sidebar')
        
        <div class="admin-content">
            @include('admin.components.header')
            
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
