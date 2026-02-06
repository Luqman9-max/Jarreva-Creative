@extends('admin.layouts.app')

@section('title', 'Admins - Jarreva Creative Admin')

@section('header_title', 'Administrators')
@section('header_subtitle', 'Manage system administrators and access.')

@section('content')
<div x-data="{ deleteModalOpen: false, deleteAction: '', deleteItem: '' }">
    <div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold text-slate-800 dark:text-white">Admin List</h2>
                <p class="text-xs text-slate-500 mt-1">Users with access to the dashboard</p>
            </div>
            <a href="{{ route('admin.admins.create') }}" class="py-2.5 px-4 bg-primary hover:bg-orange-600 text-white rounded-lg text-sm font-bold shadow-md shadow-orange-500/20 hover:shadow-orange-500/40 transition-all active:scale-95 flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Add Admin
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50 dark:bg-[#0f172a]/50 border-b border-slate-100 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider text-center">Role</th>
                        <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($admins as $admin)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($admin->profile_photo_path)
                                    <div class="size-8 rounded-full bg-cover bg-center ring-1 ring-slate-200" style="background-image: url('{{ asset('storage/' . $admin->profile_photo_path) }}');"></div>
                                @else
                                    <div class="size-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">{{ substr($admin->name, 0, 2) }}</div>
                                @endif
                                <span class="text-slate-800 dark:text-white font-bold text-sm">{{ $admin->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $admin->email }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">Administrator</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500">{{ $admin->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.admins.edit', $admin) }}" class="text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                @if(auth()->guard('admin')->id() !== $admin->id)
                                <button type="button" @click="deleteModalOpen = true; deleteAction = '{{ route('admin.admins.destroy', $admin) }}'; deleteItem = '{{ addslashes($admin->name) }}'" class="text-slate-400 hover:text-red-500 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 dark:border-slate-800">
            {{ $admins->links() }}
        </div>
    </div>
    
    {{-- Delete Confirmation Modal --}}
    <div x-show="deleteModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="relative w-full max-w-sm bg-white bg-opacity-100 rounded-2xl shadow-2xl border-0 transform transition-all"
             @click.away="deleteModalOpen = false"
             x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500"
             x-transition:enter-start="opacity-0 scale-90 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-90 translate-y-4">
             
            <div class="flex flex-col items-center p-6 text-center">
                <div class="relative mb-4 group cursor-pointer" @click="deleteModalOpen = false">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-14 h-14 bg-red-100 rounded-full animate-ping opacity-75"></div>
                    <div class="relative flex items-center justify-center w-12 h-12 bg-red-50 rounded-full border-2 border-red-100 text-red-500 transition-transform group-hover:rotate-12">
                        <span class="material-symbols-outlined text-[28px]">delete</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1.5 font-sans">
                    Delete Admin?
                </h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-6 px-4">
                    Are you sure you want to delete <span class="font-bold text-slate-800 break-words" x-text="'&quot;' + deleteItem + '&quot;'"></span>?
                </p>
                <form :action="deleteAction" method="POST" class="grid grid-cols-2 gap-3 w-full">
                    @csrf
                    @method('DELETE')
                    <button @click="deleteModalOpen = false" class="w-full py-2.5 px-4 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-lg text-slate-600 font-bold text-sm transition-all focus:ring-2 focus:ring-slate-300 focus:outline-none" type="button">
                        Cancel
                    </button>
                    <button class="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 border border-transparent rounded-lg text-white font-bold text-sm shadow-md shadow-red-500/20 transition-all focus:ring-2 focus:ring-red-500 focus:ring-offset-1 focus:outline-none" type="submit">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
