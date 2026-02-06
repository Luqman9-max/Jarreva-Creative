<div class="flex flex-col md:flex-row justify-between items-start md:items-start gap-4 w-full pt-4 lg:pt-2">
    <div class="flex flex-col gap-1">
        <h1 class="text-[#181411] dark:text-white text-3xl font-extrabold leading-tight tracking-tight">@yield('header_title', 'Dashboard Overview')</h1>
        <p class="text-[#64748b] dark:text-[#94a3b8] text-sm font-medium">@yield('header_subtitle', "Welcome back, " . Auth::guard('admin')->user()->name . "! Here's what's happening today.")</p>
    </div>
    <div class="flex flex-col items-end gap-6">
        @unless(isset($hide_global_search))
        <div class="flex items-center gap-4">
            <div class="hidden md:flex relative group">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center text-slate-400">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <input class="w-64 h-10 pl-10 pr-4 rounded-lg bg-slate-100 dark:bg-[#1e293b] border-transparent focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 text-sm transition-all" placeholder="Search books, authors..." type="text"/>
            </div>
            
            <button class="relative group p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors active:scale-95" type="button">
                <span class="material-symbols-outlined text-slate-500 dark:text-slate-400 group-hover:text-primary text-[24px]">notifications</span>
                <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-primary ring-2 ring-background-light dark:ring-background-dark"></span>
            </button>
        </div>
        @endunless

        @yield('header_actions')
    </div>
</div>
