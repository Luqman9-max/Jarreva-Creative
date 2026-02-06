@extends('admin.layouts.app')

@section('title', 'Dashboard - Jarreva Creative Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-2xl p-6 text-white shadow-lg shadow-blue-900/20 relative overflow-hidden group hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
        <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
            <span class="material-symbols-outlined" style="font-size: 100px;">book_2</span>
        </div>
        <div class="flex justify-between items-start mb-8 relative z-10">
            <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                <span class="material-symbols-outlined text-white text-[24px]">library_books</span>
            </div>
            <span class="text-xs font-bold bg-green-500/20 text-green-300 px-2 py-1 rounded-full border border-green-500/30">+12 new</span>
        </div>
        <div class="relative z-10">
            <h3 class="text-4xl font-extrabold mb-1">1,240</h3>
            <p class="text-blue-200 text-sm font-medium">Total Books</p>
        </div>
    </div>
    <div class="bg-gradient-to-br from-orange-500 to-orange-400 rounded-2xl p-6 text-white shadow-lg shadow-orange-500/20 relative overflow-hidden group hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
        <div class="absolute -bottom-4 -right-4 p-3 opacity-10 group-hover:opacity-20 transition-opacity rotate-12">
            <span class="material-symbols-outlined" style="font-size: 120px;">grade</span>
        </div>
        <div class="flex justify-between items-start mb-8 relative z-10">
            <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                <span class="material-symbols-outlined text-white text-[24px]">star</span>
            </div>
            <span class="text-xs font-bold bg-white/20 text-white px-2 py-1 rounded-full border border-white/30">High Priority</span>
        </div>
        <div class="relative z-10">
            <h3 class="text-4xl font-extrabold mb-1">48</h3>
            <p class="text-orange-50 text-sm font-medium">Featured Titles</p>
        </div>
    </div>
    <div class="bg-[#0f172a] rounded-2xl p-6 text-white shadow-lg shadow-slate-900/20 relative overflow-hidden group hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
        <div class="absolute top-1/2 right-4 -translate-y-1/2 p-3 opacity-5 group-hover:opacity-10 transition-opacity">
            <span class="material-symbols-outlined" style="font-size: 80px;">groups</span>
        </div>
        <div class="flex justify-between items-start mb-8 relative z-10">
            <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                <span class="material-symbols-outlined text-white text-[24px]">group</span>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-4xl font-extrabold mb-1">156</h3>
            <p class="text-slate-400 text-sm font-medium">Active Authors</p>
        </div>
    </div>
    <div class="bg-white dark:bg-[#1e293b] rounded-2xl p-6 border-t-4 border-primary shadow-lg shadow-slate-200/50 dark:shadow-none relative overflow-hidden flex flex-col items-center justify-center text-center gap-4 group hover:shadow-xl transition-all duration-300">
        <div class="size-12 rounded-full bg-orange-50 dark:bg-orange-900/20 text-primary flex items-center justify-center mb-1 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-[24px]">add</span>
        </div>
        <div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">Quick Action</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 max-w-[140px] mx-auto leading-relaxed">Add a new book to the catalog instantly.</p>
        </div>
        <a class="w-full py-2.5 px-4 bg-primary hover:bg-orange-600 text-white rounded-lg text-sm font-bold shadow-md shadow-orange-500/20 hover:shadow-orange-500/40 transition-all flex items-center justify-center gap-2" href="{{ route('admin.books.index') }}">
            <span class="material-symbols-outlined text-[18px]">add_circle</span>
            Add Book
        </a>
    </div>
</div>
<div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">Latest Books</h2>
            <p class="text-xs text-slate-500 mt-1">Recently added to the catalog</p>
        </div>
        <a class="text-sm font-bold text-secondary dark:text-blue-400 hover:text-primary transition-colors flex items-center gap-1" href="{{ route('admin.books.index') }}">
            View All
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50 dark:bg-[#0f172a]/50">
                <tr>
                    <th class="px-6 py-4 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-wider w-1/3">Book Details</th>
                    <th class="px-6 py-4 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-wider">Added By</th>
                    <th class="px-6 py-4 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-10 rounded shadow-sm bg-yellow-100 flex-shrink-0 overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA6IiTvI8CPQmeIqiQKGEq_IBDxR_nf4o-XB61NaeUSESaFFJpNgpk1o6FOrsE0bX4C0AhAXsfewlTGSH41H9xaRzjp2SBnk5_sfPe9IFvlMdDAYgoBghRUihX38IX4jH2xYbsc__5HPGCEs6d1PpKwjh3MduMgQ7TwTi_1Q4_soAJfYbkq5M6BQj0Lkakld4v1P15vzcFjyMArHuI4c-MF1nw-KxkUn-FVJyhZfpY_GtJsw5uQi2DeHDoK3g2wBsOP6RrFhNtJk-w");'></div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-slate-800 dark:text-white font-bold text-sm">The Art of Modern Design</span>
                                <span class="text-slate-400 text-xs font-medium mt-0.5">ISBN: 978-1-56619-909-4</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="size-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold">AM</div>
                            <span class="text-slate-600 dark:text-slate-300 text-sm font-medium">Alex Morgan</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Published</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <button class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            <button class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30 text-slate-400 hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-10 rounded shadow-sm bg-green-100 flex-shrink-0 overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAcP3TImSrm4yXa0lvjk_egSC8mrbW2SfYZ2yBffcZv63TjImBCUSErufxWq51cdcuisPz84rBHZnhn-BNKXuMRJ-RdwlUy8avOxP7sXQmFb1mvdjnP1J-OE7uecr65mN-VZuV-04CufKC4Q2UDH1h0lgYZwLYhgyK4l-0VhP7mDO76npUE8x-luN2d2JWj_rMjjn0hmnezcF2QcDwHCIroYw_70BMGzZ3cX6rP2gJiv9Mht9rzg-Lx9UxdfrI3pDxQz829PzRWIno");'></div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-slate-800 dark:text-white font-bold text-sm">Effective UI Patterns</span>
                                <span class="text-slate-400 text-xs font-medium mt-0.5">ISBN: 978-0-12345-678-9</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="size-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-[10px] font-bold">JD</div>
                            <span class="text-slate-600 dark:text-slate-300 text-sm font-medium">Jane Doe</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Published</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <button class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            <button class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30 text-slate-400 hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-10 rounded shadow-sm bg-red-100 flex-shrink-0 overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCTpNy4hzGdhLpygRVhtqQqPIWY0BTWmtqee3UC6CZdbds5z8ptVvvxwTo9DKEaDSOuCq5-ifOFCUJ-uuLYWm1QA-TJMDax_wsD2teRxQrmuEB-tbr0yhC565HY3pYMms-5TOrrD-3whIYnxEQRSscVjk5NbmdLKYyJNs0sxFhO96ouwy9ufYbLdeT7iWyJAto8eoJy7qrsDUlclqAf6WN4Ie6RXyJQtUvMu7WjmGZh7PTZUY_uYHzPEqlDZqYfOFDtn_qXcdMaxrI");'></div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-slate-800 dark:text-white font-bold text-sm">Creative Coding for Web</span>
                                <span class="text-slate-400 text-xs font-medium mt-0.5">ISBN: 978-3-16-148410-0</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="size-6 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-[10px] font-bold">SM</div>
                            <span class="text-slate-600 dark:text-slate-300 text-sm font-medium">Sarah Miller</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300">Draft</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <button class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            <button class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30 text-slate-400 hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-10 rounded shadow-sm bg-blue-100 flex-shrink-0 overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAyV_-UhiklZdJnxRSCRxTZmUNOwp_y60fBWyEEqisjFH6xxnM4WW2kZF3phzO5EG0NClNz8iw7idAz8CBttLUGgZOUIy_sMPogTNYkCgYlUTdx5L_Y47Ftz-RbjZo6W5QsvyqP00brFDWc2jIlWFVKYUt2hiKjgIJfpyLH44OH8RUAlxo61tN1Zw5VaeqcE2NzLSxzRJDsdWFUAuR5zwkBC2tzjm1_yXBPfNiXvPKz3xdSd5K1VG-AKT0aa7dcjI1pADPdNg_20Xw");'></div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-slate-800 dark:text-white font-bold text-sm">Digital Marketing 101</span>
                                <span class="text-slate-400 text-xs font-medium mt-0.5">ISBN: 978-0-555-01928-1</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="size-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold">AM</div>
                            <span class="text-slate-600 dark:text-slate-300 text-sm font-medium">Alex Morgan</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Published</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <button class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            <button class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30 text-slate-400 hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors group border-b-0">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-10 rounded shadow-sm bg-emerald-100 flex-shrink-0 overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAv5qXIgOm_lJpqLk61DY4uDcE1IwXRrGOQLUw0uecvBkyGoaubqk-UxBAODoJg3PJbvNyyWvcaEdmruifDGCPAmUdjktY89lQ-5c7vFeYSeA3Qe0duNHG_OKS4Pi0-xw990gUllLLNXo8CnuNfIoTICdKlIvmey60Cq-NHC0KQ3hbH7XKhC7YCr2Vj573TZ2tbQBY9-EwIpgs8yNk3BSO98HK0sNNt7PoywnuIioteGH0kZGcXFGn-um0d3oNtnldqMqX9G85pnlI");'></div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-slate-800 dark:text-white font-bold text-sm">Brand Identity Systems</span>
                                <span class="text-slate-400 text-xs font-medium mt-0.5">ISBN: 978-0-444-55555-5</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="size-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-[10px] font-bold">JD</div>
                            <span class="text-slate-600 dark:text-slate-300 text-sm font-medium">Jane Doe</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Published</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <button class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            <button class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30 text-slate-400 hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
