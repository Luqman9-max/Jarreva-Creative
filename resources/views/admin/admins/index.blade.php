@extends('admin.layouts.app')

@section('title', 'Admins - Jarreva Creative Admin')

@section('header_title', 'Administrators')
@section('header_subtitle', 'Manage system administrators and access.')

@section('content')
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
                            <a href="{{ route('admin.admins.edit', $admin) }}" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            @if(auth()->guard('admin')->id() !== $admin->id)
                            <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" onsubmit="return confirm('Delete this admin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30 text-slate-400 hover:text-red-500 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
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
@endsection
