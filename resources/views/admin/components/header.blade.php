<div class="flex flex-col md:flex-row justify-between items-start md:items-start gap-4 w-full pt-4 lg:pt-2">
    <div class="flex flex-col gap-1">
        <h1 class="text-[#181411] dark:text-white text-3xl font-extrabold leading-tight tracking-tight">@yield('header_title', 'Dashboard Overview')</h1>
        <p class="text-[#64748b] dark:text-[#94a3b8] text-sm font-medium">@yield('header_subtitle', "Welcome back, " . Auth::guard('admin')->user()->name . "! Here's what's happening today.")</p>
    </div>
    <div class="flex items-center gap-4">
        @unless(isset($hide_global_search))
        <form action="{{ route('admin.books.index') }}" method="GET" class="hidden md:flex relative group">
            <div class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center text-slate-400">
                <span class="material-symbols-outlined text-[20px]">search</span>
            </div>
            <input name="search" class="w-64 h-10 pl-10 pr-4 rounded-lg bg-slate-100 dark:bg-[#1e293b] border-transparent focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 text-sm transition-all outline-none" placeholder="Search books, authors..." type="text"/>
        </form>
        @endunless

        @yield('header_actions')
        
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="relative group p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors active:scale-95" type="button">
                <span class="material-symbols-outlined text-slate-500 dark:text-slate-400 group-hover:text-primary text-[24px]">notifications</span>
                @if(isset($activities) && $activities->count() > 0)
                    <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-primary ring-2 ring-background-light dark:ring-background-dark animate-pulse"></span>
                @endif
            </button>
            
            {{-- Notification Dropdown --}}
            <div x-show="open" 
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-1"
                 class="absolute right-0 mt-3 w-80 md:w-96 bg-white dark:bg-[#1e293b] rounded-2xl shadow-xl ring-1 ring-black/5 z-50 overflow-hidden" 
                 style="display: none;">
                
                <div class="p-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-[#0f172a]/30 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800 dark:text-white text-sm">Recent Activity</h3>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">New</span>
                </div>

                <div class="max-h-[400px] overflow-y-auto">
                    @if(isset($activities) && $activities->count() > 0)
                        <div class="divide-y divide-slate-100 dark:divide-slate-700">
                            @foreach($activities as $log)
                                <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors flex gap-3">
                                    <div class="flex-shrink-0 mt-1">
                                        @if($log->action == 'created')
                                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                                <span class="material-symbols-outlined text-[16px]">add</span>
                                            </div>
                                        @elseif($log->action == 'updated')
                                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                                <span class="material-symbols-outlined text-[16px]">edit</span>
                                            </div>
                                        @elseif($log->action == 'deleted')
                                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                            </div>
                                        @else
                                             <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600">
                                                <span class="material-symbols-outlined text-[16px]">info</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-800 dark:text-gray-200 font-medium leading-snug">{{ $log->description }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">{{ $log->admin->name ?? 'System' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 text-center text-slate-400">
                            <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">notifications_off</span>
                            <p class="text-sm">No recent activity.</p>
                        </div>
                    @endif
                </div>
                
                <div class="p-3 border-t border-slate-100 dark:border-slate-700 text-center bg-slate-50/50 dark:bg-[#0f172a]/30">
                    <a href="{{ route('admin.activity-logs.index') }}" class="text-xs font-bold text-primary hover:text-orange-600 transition-colors">View All Logs</a>
                </div>
            </div>
        </div>
    </div>
</div>
