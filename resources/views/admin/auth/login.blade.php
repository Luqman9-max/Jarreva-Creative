<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Jarreva Creative Admin - Login</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    {{-- Vite Scripts & Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen w-full flex items-center justify-center p-4 md:p-6 lg:p-8 font-sans text-slate-800 relative overflow-hidden group/page">
    
    {{-- Background Animated Elements --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden select-none z-0">
        <div class="absolute top-[10%] left-[10%] w-6 h-6 bg-blue-400/30 rounded-full blur-[4px] animate-float-p1 transition-transform duration-700 ease-out group-hover/page:translate-x-4 group-hover/page:translate-y-4"></div>
        <div class="absolute top-[40%] left-[5%] w-12 h-12 bg-blue-300/20 rounded-full blur-[8px] animate-float-p2 transition-transform duration-700 ease-out group-hover/page:-translate-x-4 group-hover/page:translate-y-2"></div>
        <div class="absolute bottom-[20%] left-[15%] w-4 h-4 bg-secondary/40 rounded-full blur-[2px] animate-float-p3 transition-transform duration-700 ease-out group-hover/page:translate-x-6"></div>
        <div class="absolute top-[15%] right-[20%] w-8 h-8 bg-blue-200/25 rounded-full blur-[6px] animate-float-p2 transition-transform duration-700 ease-out group-hover/page:-translate-y-4"></div>
        <div class="absolute top-[20%] right-[10%] w-5 h-5 bg-orange-400/30 rounded-full blur-[3px] animate-float-p1 transition-transform duration-700 ease-out group-hover/page:-translate-x-4 group-hover/page:-translate-y-4"></div>
        <div class="absolute bottom-[30%] right-[5%] w-10 h-10 bg-orange-300/20 rounded-full blur-[8px] animate-float-p3 transition-transform duration-700 ease-out group-hover/page:translate-x-4"></div>
        <div class="absolute top-[60%] left-[20%] w-6 h-6 bg-primary/25 rounded-full blur-[4px] animate-float-p2 transition-transform duration-700 ease-out group-hover/page:translate-y-6"></div>
        <div class="absolute bottom-[10%] right-[25%] w-7 h-7 bg-orange-200/30 rounded-full blur-[3px] animate-float-p1 transition-transform duration-700 ease-out group-hover/page:-translate-x-6"></div>
        <div class="absolute top-[5%] left-[45%] w-3 h-3 bg-blue-500/20 rounded-full blur-[2px] animate-float transition-transform duration-1000 group-hover/page:translate-y-[-10px]"></div>
        <div class="absolute top-[25%] left-[35%] w-16 h-16 bg-blue-100/10 rounded-full blur-[12px] animate-float-slow transition-transform duration-1000 group-hover/page:translate-x-8"></div>
        <div class="absolute bottom-[40%] left-[8%] w-5 h-5 bg-secondary/15 rounded-full blur-[4px] animate-float-p1 transition-transform duration-1000 group-hover/page:-translate-x-2"></div>
        <div class="absolute top-[80%] left-[40%] w-4 h-4 bg-blue-300/30 rounded-full blur-[3px] animate-float-p2 delay-700 transition-transform duration-1000 group-hover/page:translate-y-4"></div>
        <div class="absolute top-[12%] left-[85%] w-9 h-9 bg-blue-400/15 rounded-full blur-[10px] animate-float-p3 delay-1000 transition-transform duration-1000 group-hover/page:-translate-x-4"></div>
        <div class="absolute top-[55%] right-[35%] w-4 h-4 bg-orange-400/25 rounded-full blur-[3px] animate-float-p1 delay-500 transition-transform duration-1000 group-hover/page:translate-x-2 group-hover/page:-translate-y-2"></div>
        <div class="absolute bottom-[15%] left-[50%] w-8 h-8 bg-orange-100/20 rounded-full blur-[6px] animate-float delay-200 transition-transform duration-1000 group-hover/page:-translate-y-6"></div>
        <div class="absolute top-[35%] right-[45%] w-3 h-3 bg-primary/30 rounded-full blur-[2px] animate-float-p3 delay-300 transition-transform duration-1000 group-hover/page:translate-x-3"></div>
        <div class="absolute top-[90%] right-[15%] w-20 h-20 bg-slate-300/10 rounded-full blur-[15px] animate-float-slow transition-transform duration-1000 group-hover/page:-translate-x-8"></div>
        <div class="absolute top-[50%] left-[50%] w-2 h-2 bg-secondary/40 rounded-full blur-sm animate-pulse transition-transform duration-500 group-hover/page:scale-150"></div>
        <div class="absolute top-[20%] left-[60%] w-32 h-32 bg-blue-500/5 rounded-full blur-[40px] animate-pulse-glow"></div>
        <div class="absolute bottom-[10%] right-[60%] w-24 h-24 bg-orange-500/5 rounded-full blur-[30px] animate-pulse-glow delay-1000"></div>
        <div class="absolute top-[70%] left-[10%] w-14 h-14 bg-indigo-400/10 rounded-full blur-[10px] animate-float-slow"></div>
        <div class="absolute top-[5%] right-[5%] w-10 h-10 bg-sky-200/20 rounded-full blur-[5px] animate-float-p2"></div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl overflow-hidden flex flex-col md:flex-row min-h-[600px] border border-slate-100 relative z-10">
        
        {{-- Left Side (Visual) --}}
        <div class="hidden md:flex w-1/2 relative overflow-hidden flex-col justify-between group/left cursor-default mesh-gradient-bg" onmousemove="document.documentElement.style.setProperty('--mouse-x', `${(event.clientX - this.getBoundingClientRect().left) / this.offsetWidth * 100}%`); document.documentElement.style.setProperty('--mouse-y', `${(event.clientY - this.getBoundingClientRect().top) / this.offsetHeight * 100}%`);">
            <div class="absolute inset-0 z-0 opacity-80 mix-blend-hard-light pointer-events-none">
                <div class="absolute -top-[20%] -left-[20%] w-[120%] h-[120%] bg-[radial-gradient(circle,rgba(249,115,22,0.6)_0%,transparent_60%)] blur-3xl animate-float-p3 transition-transform duration-700 ease-out group-hover/left:translate-x-8 group-hover/left:translate-y-8"></div>
                <div class="absolute top-[30%] -right-[30%] w-[100%] h-[100%] bg-[radial-gradient(circle,rgba(30,58,138,0.3)_0%,transparent_60%)] blur-3xl animate-float-p2 transition-transform duration-700 ease-out group-hover/left:-translate-x-12 group-hover/left:-translate-y-6"></div>
                <div class="absolute -bottom-[40%] left-[10%] w-[100%] h-[100%] bg-[radial-gradient(circle,rgba(15,23,42,0.8)_0%,transparent_70%)] blur-2xl animate-float-p1 transition-transform duration-1000 ease-out group-hover/left:translate-y-[-40px]"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_var(--mouse-x,50%)_var(--mouse-y,50%),rgba(255,255,255,0.08),transparent_40%)] opacity-100 transition-opacity duration-300"></div>
            </div>
            
            {{-- Background Pattern Overlay (Optional - using CSS pattern if image fails) --}}
            <div class="absolute inset-0 bg-[url('https://lh3.googleusercontent.com/aida-public/AB6AXuA6IiTvI8CPQmeIqiQKGEq_IBDxR_nf4o-XB61NaeUSESaFFJpNgpk1o6FOrsE0bX4C0AhAXsfewlTGSH41H9xaRzjp2SBnk5_sfPe9IFvlMdDAYgoBghRUihX38IX4jH2xYbsc__5HPGCEs6d1PpKwjh3MduMgQ7TwTi_1Q4_soAJfYbkq5M6BQj0Lkakld4v1P15vzcFjyMArHuI4c-MF1nw-KxkUn-FVJyhZfpY_GtJsw5uQi2DeHDoK3g2wBsOP6RrFhNtJk-w')] bg-cover bg-center opacity-10 mix-blend-overlay z-0 pointer-events-none"></div>

            <div class="relative z-20 p-12 text-white pointer-events-none">
                <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center mb-6 border border-white/20 shadow-[0_0_15px_rgba(255,255,255,0.1)] group-hover/left:shadow-[0_0_25px_rgba(255,255,255,0.2)] transition-shadow duration-300">
                    <span class="material-symbols-outlined text-white">admin_panel_settings</span>
                </div>
                <h2 class="text-2xl font-bold tracking-tight opacity-90 font-display">Secure Access</h2>
                <p class="text-blue-50 mt-2 text-sm max-w-xs leading-relaxed font-sans">Manage your creative assets and team workflows securely.</p>
            </div>

            {{-- Animated Figures --}}
            <div class="relative z-20 w-full flex items-end justify-center space-x-2 lg:space-x-4 -mb-12 px-8 pointer-events-none">
                {{-- Purple Figure --}}
                <div class="w-20 h-40 bg-purple-500 rounded-t-full relative shadow-lg transform transition-transform duration-500 ease-out group-hover/left:translate-y-2 group-hover/left:rotate-[-6deg] origin-bottom pointer-events-auto hover:!scale-105 ring-1 ring-white/10">
                    <div class="absolute top-12 left-1/2 -translate-x-1/2 flex gap-2">
                        <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-2.5 h-2.5 bg-slate-900 rounded-full animate-blink group-hover/left:translate-x-[2px] transition-transform duration-300"></div>
                        </div>
                        <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-2.5 h-2.5 bg-slate-900 rounded-full animate-blink group-hover/left:translate-x-[2px] transition-transform duration-300"></div>
                        </div>
                    </div>
                    <div class="absolute bottom-16 left-1/2 -translate-x-1/2 w-4 h-2 bg-purple-700 rounded-full opacity-30"></div>
                </div>

                {{-- Dark Blue Figure --}}
                <div class="w-24 h-52 bg-slate-900 rounded-t-full relative shadow-xl z-20 transform transition-transform duration-700 ease-out group-hover/left:-translate-y-1 group-hover/left:rotate-[2deg] origin-bottom pointer-events-auto hover:!scale-105 border border-white/5">
                    <div class="absolute top-16 left-1/2 -translate-x-1/2 flex gap-3">
                        <div class="w-7 h-7 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-3 h-3 bg-slate-900 rounded-full animate-[blink_5s_infinite_ease-in-out_0.5s] group-hover/left:translate-x-[-2px] group-hover/left:translate-y-[-1px] transition-transform duration-300"></div>
                        </div>
                        <div class="w-7 h-7 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-3 h-3 bg-slate-900 rounded-full animate-[blink_5s_infinite_ease-in-out_0.5s] group-hover/left:translate-x-[-2px] group-hover/left:translate-y-[-1px] transition-transform duration-300"></div>
                        </div>
                    </div>
                    <div class="absolute top-28 left-1/2 -translate-x-1/2 w-6 h-3 border-b-2 border-slate-700 rounded-full"></div>
                    <div class="absolute top-36 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[8px] border-l-transparent border-t-[12px] border-t-red-500 border-r-[8px] border-r-transparent"></div>
                    <div class="absolute top-[156px] left-1/2 -translate-x-1/2 w-3 h-16 bg-red-500 rounded-b-sm"></div>
                </div>

                {{-- Orange Figure --}}
                <div class="w-20 h-36 bg-[#F97316] rounded-t-full relative shadow-lg transform transition-transform duration-500 ease-out group-hover/left:translate-y-4 group-hover/left:rotate-[5deg] origin-bottom pointer-events-auto hover:!scale-105 ring-1 ring-white/10">
                    <div class="absolute top-10 left-1/2 -translate-x-1/2 flex gap-1.5">
                        <div class="w-5 h-5 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-2 h-2 bg-slate-900 rounded-full animate-[blink_3s_infinite_ease-in-out_1s] group-hover/left:translate-y-[2px] transition-transform duration-300"></div>
                        </div>
                        <div class="w-5 h-5 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-2 h-2 bg-slate-900 rounded-full animate-[blink_3s_infinite_ease-in-out_1s] group-hover/left:translate-y-[2px] transition-transform duration-300"></div>
                        </div>
                    </div>
                    <div class="absolute top-5 left-1/2 -translate-x-1/2 w-12 h-4 bg-orange-600 rounded-full opacity-20 rotate-3"></div>
                </div>

                {{-- Yellow Figure --}}
                <div class="w-16 h-28 bg-yellow-400 rounded-t-full relative shadow-md transform transition-transform duration-500 ease-out group-hover/left:translate-x-2 group-hover/left:rotate-[-10deg] origin-bottom pointer-events-auto hover:!scale-105 ring-1 ring-white/10">
                    <div class="absolute top-8 left-1/2 -translate-x-1/2 flex gap-1">
                        <div class="w-4 h-4 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-1.5 h-1.5 bg-slate-900 rounded-full animate-[blink_6s_infinite_ease-in-out_2s] group-hover/left:-translate-x-[1px] transition-transform duration-300"></div>
                        </div>
                        <div class="w-4 h-4 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                            <div class="w-1.5 h-1.5 bg-slate-900 rounded-full animate-[blink_6s_infinite_ease-in-out_2s] group-hover/left:-translate-x-[1px] transition-transform duration-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Side (Form) --}}
        <div class="w-full md:w-1/2 bg-[#f8fafc] p-8 md:p-12 lg:p-16 flex flex-col justify-center relative">
            <div class="absolute top-8 right-8 md:top-12 md:right-12">
                <a class="text-xs font-semibold text-slate-400 hover:text-secondary transition-colors font-sans" href="#">Need help?</a>
            </div>
            
            <div class="max-w-md w-full mx-auto">
                <div class="mb-8">
                    <h3 class="text-secondary font-bold text-sm uppercase tracking-wider mb-2 font-display">Jarreva Creative Admin</h3>
                    <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight font-display">Welcome back!</h1>
                    <p class="text-slate-500 mt-2 text-sm font-sans">Please enter your details to access the dashboard.</p>
                </div>
                
                <form class="space-y-6" action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    
                    {{-- Error Message --}}
                    @if ($errors->any())
                        <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-1">
                        <label class="block text-sm font-semibold text-slate-700 ml-1 font-sans" for="email">Email Address</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 text-[20px]">mail</span>
                            <input class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-secondary/20 focus:border-secondary block pl-10 p-3 shadow-sm placeholder-slate-400 outline-none transition-all duration-200 font-sans" id="email" name="email" placeholder="name@jarreva.com" required="" type="email" value="{{ old('email') }}"/>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-semibold text-slate-700 ml-1 font-sans" for="password">Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 text-[20px]">lock</span>
                            <input class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-secondary/20 focus:border-secondary block pl-10 p-3 shadow-sm placeholder-slate-400 outline-none transition-all duration-200 font-sans" id="password" name="password" placeholder="••••••••" required="" type="password"/>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900 focus:ring-2 focus:ring-offset-2 relative z-20 cursor-pointer" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}/>
                            <label class="ml-2 text-sm font-medium text-slate-600 cursor-pointer select-none font-sans relative z-20" for="remember">Remember me</label>
                        </div>
                        <a class="text-sm font-semibold text-secondary hover:text-primary transition-colors font-sans" href="#">Forgot password?</a>
                    </div>
                    
                    <button class="w-full relative overflow-hidden jarreva-gradient hover:opacity-90 text-white font-bold rounded-lg text-sm px-5 py-3.5 uppercase tracking-wider shadow-lg hover:shadow-xl transform active:scale-[0.99] transition-all duration-200 group font-display" type="submit">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Log in <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </span>
                        <div class="absolute inset-0 h-full w-full bg-white/20 -skew-x-12 -translate-x-full group-hover:animate-[shimmer_1s_infinite]"></div>
                    </button>
                </form>
                
                <div class="mt-8 pt-8 border-t border-slate-200 text-center">
                    <p class="text-slate-500 text-sm font-sans">Protected by Jarreva Enterprise Security</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
