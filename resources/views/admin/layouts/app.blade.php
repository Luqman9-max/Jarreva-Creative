<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Jarreva Creative Admin')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans overflow-hidden">
    <div class="flex h-screen w-full">
        
        {{-- Sidebar --}}
        <aside class="flex flex-col w-64 h-full bg-sidebar-bg text-sidebar-text flex-shrink-0 transition-all duration-300 z-20 shadow-xl border-r border-blue-100 hidden md:flex">
            @include('admin.components.sidebar')
        </aside>

        {{-- Mobile Menu Button (Visible only on mobile) --}}
        <div class="md:hidden fixed top-4 left-4 z-50">
            <button class="p-2 bg-white rounded-lg shadow-md text-primary">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col min-w-0 bg-background-light dark:bg-background-dark overflow-hidden h-full">
            <div class="flex-1 overflow-y-auto main-scroll p-6 md:p-10 lg:p-12">
                <div class="max-w-[1600px] w-full mx-auto flex flex-col gap-8">
                    {{-- Top Header (Search, Profile, etc) --}}
                    @include('admin.components.header')

                    {{-- Page Content --}}
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @if (session('login_success'))
    <div id="login-success-overlay" class="fixed inset-0 z-50 login-bg-pattern overflow-hidden font-sans text-slate-800 transition-opacity duration-700">
        <div class="absolute inset-0 bg-gradient-to-r from-secondary/20 to-sky-100 opacity-80 z-0"></div>
        <div class="absolute inset-0 z-0 flex p-4 opacity-40 scale-105 origin-center filter blur-sm transition-all duration-1000">
            <div class="w-64 h-full bg-white rounded-xl shadow-sm mr-4 flex flex-col p-4 border border-slate-200">
                <div class="h-8 w-32 bg-slate-200 rounded mb-8"></div>
                <div class="space-y-4">
                    <div class="h-4 w-full bg-slate-100 rounded"></div>
                    <div class="h-4 w-3/4 bg-slate-100 rounded"></div>
                    <div class="h-4 w-5/6 bg-slate-100 rounded"></div>
                </div>
            </div>
            <div class="flex-1 h-full bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex justify-between items-center mb-8">
                    <div class="h-8 w-48 bg-slate-200 rounded"></div>
                    <div class="flex space-x-2">
                        <div class="h-8 w-8 bg-slate-200 rounded-full"></div>
                        <div class="h-8 w-8 bg-slate-200 rounded-full"></div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                    <div class="h-32 bg-blue-50 rounded-lg border border-blue-100"></div>
                    <div class="h-32 bg-orange-50 rounded-lg border border-orange-100"></div>
                    <div class="h-32 bg-purple-50 rounded-lg border border-purple-100"></div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl overflow-hidden flex flex-col md:flex-row min-h-[600px] border border-slate-100 transform scale-90 opacity-40 blur-[1px] transition-all duration-700">
                <div class="hidden md:flex w-1/2 bg-gradient-to-br from-secondary to-blue-900 relative overflow-hidden flex-col justify-between">
                    <div class="absolute inset-0 bg-[url('https://lh3.googleusercontent.com/aida-public/AB6AXuA6IiTvI8CPQmeIqiQKGEq_IBDxR_nf4o-XB61NaeUSESaFFJpNgpk1o6FOrsE0bX4C0AhAXsfewlTGSH41H9xaRzjp2SBnk5_sfPe9IFvlMdDAYgoBghRUihX38IX4jH2xYbsc__5HPGCEs6d1PpKwjh3MduMgQ7TwTi_1Q4_soAJfYbkq5M6BQj0Lkakld4v1P15vzcFjyMArHuI4c-MF1nw-KxkUn-FVJyhZfpY_GtJsw5uQi2DeHDoK3g2wBsOP6RrFhNtJk-w')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
                    <div class="relative z-10 p-12 text-white opacity-50">
                        <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center mb-6 border border-white/20">
                            <span class="material-symbols-outlined text-white">admin_panel_settings</span>
                        </div>
                        <h2 class="text-2xl font-bold tracking-tight">Secure Access</h2>
                    </div>
                </div>
                <div class="w-full md:w-1/2 bg-[#f8fafc] p-8 md:p-12 lg:p-16 flex flex-col justify-center opacity-50">
                    <div class="max-w-md w-full mx-auto">
                        <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight font-display mb-8">Welcome back!</h1>
                        <div class="space-y-4 opacity-50">
                            <div class="h-12 bg-slate-200 rounded-lg w-full"></div>
                            <div class="h-12 bg-slate-200 rounded-lg w-full"></div>
                            <div class="h-12 bg-secondary rounded-lg w-full mt-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 z-20 pointer-events-none overflow-hidden">
            <div class="absolute bottom-16 left-[8%] md:left-[15%] transition-all duration-1000 transform -translate-y-24 rotate-[-12deg] scale-75">
                <div class="w-20 h-40 bg-purple-500 rounded-t-full relative shadow-lg">
                    <div class="absolute top-12 left-1/2 -translate-x-1/2 flex gap-2">
                        <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-2.5 h-2.5 bg-slate-900 rounded-full translate-x-0.5"></div>
                        </div>
                        <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-2.5 h-2.5 bg-slate-900 rounded-full translate-x-0.5"></div>
                        </div>
                    </div>
                    <div class="absolute top-0 -right-8 space-y-2 opacity-60">
                        <div class="w-12 h-1 bg-purple-300 rounded-full"></div>
                        <div class="w-8 h-1 bg-purple-300 rounded-full ml-2"></div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-4 left-[2%] md:left-[5%] transition-all duration-1000 transform translate-y-4 rotate-[5deg] scale-90 z-30">
                <div class="w-24 h-52 bg-slate-900 rounded-t-full relative shadow-xl">
                    <div class="absolute top-16 left-1/2 -translate-x-1/2 flex gap-3">
                        <div class="w-7 h-7 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-3 h-3 bg-slate-900 rounded-full -translate-y-1"></div> 
                        </div>
                        <div class="w-7 h-7 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-3 h-3 bg-slate-900 rounded-full -translate-y-1"></div>
                        </div>
                    </div>
                    <div class="absolute top-28 left-1/2 -translate-x-1/2 w-8 h-4 border-b-4 border-slate-700 rounded-full"></div> 
                    <div class="absolute top-36 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[8px] border-l-transparent border-t-[12px] border-t-red-500 border-r-[8px] border-r-transparent"></div>
                    <div class="absolute top-[156px] left-1/2 -translate-x-1/2 w-3 h-16 bg-red-500 rounded-b-sm"></div>
                </div>
            </div>
            <div class="absolute bottom-24 left-[20%] md:left-[22%] transition-all duration-1000 transform -translate-x-12 rotate-[15deg] scale-75 blur-[0.5px]">
                <div class="w-20 h-36 bg-[#F97316] rounded-t-full relative shadow-lg">
                    <div class="absolute top-10 left-1/2 -translate-x-1/2 flex gap-1.5">
                        <div class="w-5 h-5 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-2 h-2 bg-slate-900 rounded-full"></div>
                        </div>
                        <div class="w-5 h-5 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-2 h-2 bg-slate-900 rounded-full"></div>
                        </div>
                    </div>
                    <div class="absolute top-5 left-1/2 -translate-x-1/2 w-12 h-4 bg-orange-600 rounded-full opacity-20 rotate-3"></div>
                </div>
            </div>
            <div class="absolute -bottom-10 left-[12%] md:left-[10%] transition-all duration-1000 transform -rotate-[5deg] scale-90 z-20">
                <div class="w-16 h-28 bg-yellow-400 rounded-t-full relative shadow-md">
                    <div class="absolute top-8 left-1/2 -translate-x-1/2 flex gap-1">
                        <div class="w-4 h-4 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-1.5 h-1.5 bg-slate-900 rounded-full"></div>
                        </div>
                        <div class="w-4 h-4 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-1.5 h-1.5 bg-slate-900 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 flex items-center justify-center z-40">
            <div class="text-center animate-success-pulse">
                <div class="w-20 h-20 bg-green-500 rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg shadow-green-500/30 transform scale-110">
                    <span class="material-symbols-outlined text-white text-5xl">check</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-2 font-sans tracking-tight">Login Successful</h2>
                <p class="text-slate-500 font-medium text-lg flex items-center justify-center gap-2">
                    <span class="w-2 h-2 bg-primary rounded-full animate-ping"></span>
                    Redirecting to dashboard...
                </p>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-orange-400 rounded-full filter blur-[80px] opacity-20 -z-10"></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('login-success-overlay');
            if (overlay) {
                setTimeout(() => {
                    overlay.classList.add('opacity-0');
                    setTimeout(() => {
                        overlay.remove();
                    }, 700);
                }, 3000);
            }
        });
    </script>
    @endif

    {{-- Notification System --}}
    @if (session('success') || session('delete'))
    <div id="notification-overlay" class="fixed top-6 right-6 z-50 transition-all duration-500 transform translate-x-0 opacity-100">
        @if (session('success'))
        {{-- Success Notification (Orange) --}}
        <div class="flex items-start gap-4 p-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-md border-l-4 border-orange-500 rounded-r-lg shadow-xl ring-1 ring-black/5 min-w-[320px] max-w-sm">
            <div class="flex-shrink-0">
                <span class="material-symbols-outlined text-orange-500 text-xl font-bold mt-0.5">check_circle</span>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-sm text-slate-900 dark:text-white leading-tight mb-1 font-sans">Success</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium leading-relaxed font-sans">{{ session('success') }}</p>
            </div>
            <button onclick="closeNotification()" class="flex-shrink-0 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors ml-2 p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full cursor-pointer">
                <span class="material-symbols-outlined text-lg block">close</span>
            </button>
        </div>
        @elseif (session('delete'))
        {{-- Delete Notification (Red) --}}
        <div class="flex items-start gap-4 p-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-md border-l-4 border-red-500 rounded-r-lg shadow-xl ring-1 ring-black/5 min-w-[320px] max-w-sm">
            <div class="flex-shrink-0">
                <span class="material-symbols-outlined text-red-500 text-xl font-bold mt-0.5">delete</span>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-sm text-slate-900 dark:text-white leading-tight mb-1 font-sans">Deleted</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium leading-relaxed font-sans">{{ session('delete') }}</p>
            </div>
            <button onclick="closeNotification()" class="flex-shrink-0 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors ml-2 p-1 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full cursor-pointer">
                <span class="material-symbols-outlined text-lg block">close</span>
            </button>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const notification = document.getElementById('notification-overlay');
            if (notification) {
                // Auto dismiss after 4 seconds
                setTimeout(() => {
                    closeNotification();
                }, 4000);
            }
        });

        function closeNotification() {
            const notification = document.getElementById('notification-overlay');
            if (notification) {
                notification.classList.remove('translate-x-0', 'opacity-100');
                notification.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }
        }
    </script>
    @endif
    @yield('scripts')
</body>
</html>
