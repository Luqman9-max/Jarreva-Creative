@extends('admin.layouts.app')

@section('title', 'Activity Logs - Jarreva Creative Admin')

@section('header_title', 'Activity Logs')
@section('header_subtitle', 'Monitor all administrative actions and system events.')

@section('content')

{{-- Logs Table --}}
<div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50 dark:bg-[#0f172a]/50 border-b border-slate-100 dark:border-slate-800">
                <tr>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Action</th>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Description</th>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($logs as $log)
                <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                             @if($log->admin && $log->admin->profile_photo_path)
                                <div class="h-8 w-8 rounded-full bg-cover bg-center border border-slate-200" style="background-image: url('{{ asset('storage/' . $log->admin->profile_photo_path) }}');"></div>
                            @else
                                <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                    {{ substr($log->admin->name ?? 'S', 0, 1) }}
                                </div>
                            @endif
                            <div class="flex flex-col">
                                <span class="text-slate-800 dark:text-white font-bold text-sm">{{ $log->admin->name ?? 'System' }}</span>
                                <span class="text-slate-400 text-xs">{{ $log->admin->email ?? '-' }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($log->action == 'created')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Created</span>
                        @elseif($log->action == 'updated')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">Updated</span>
                        @elseif($log->action == 'deleted')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">Deleted</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">{{ ucfirst($log->action) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-600 dark:text-slate-300 font-medium">{{ $log->description }}</p>
                        @if($log->subject_type)
                            <p class="text-xs text-slate-400 mt-0.5">Ref: {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm text-slate-600 dark:text-slate-300 font-medium">{{ $log->created_at->format('M d, Y') }}</span>
                            <span class="text-xs text-slate-400">{{ $log->created_at->format('H:i') }}</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <span class="material-symbols-outlined text-[48px] text-slate-300 mb-4">history_toggle_off</span>
                            <p class="font-medium">No activity logs found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer Pagination --}}
    <div class="p-6 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-sm text-slate-500">
            Showing <span class="font-bold text-slate-800 dark:text-white">{{ $logs->firstItem() ?? 0 }}-{{ $logs->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-800 dark:text-white">{{ $logs->total() }}</span> logs
        </p>
        
        {{-- Custom Pagination Links --}}
        @if($logs->hasPages())
        <div class="flex gap-1">
            {{-- Previous Page Link --}}
            @if ($logs->onFirstPage())
                <span class="px-3 py-1 text-slate-300 cursor-not-allowed"><span class="material-symbols-outlined text-sm">chevron_left</span></span>
            @else
                <a href="{{ $logs->previousPageUrl() }}" class="px-3 py-1 text-slate-500 hover:text-primary transition-colors"><span class="material-symbols-outlined text-sm">chevron_left</span></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($logs->elements()[0] as $page => $url)
                @if ($page == $logs->currentPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white text-sm font-bold shadow-md shadow-orange-500/20">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-600 hover:bg-slate-50 text-sm font-medium transition-colors">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($logs->hasMorePages())
                <a href="{{ $logs->nextPageUrl() }}" class="px-3 py-1 text-slate-500 hover:text-primary transition-colors"><span class="material-symbols-outlined text-sm">chevron_right</span></a>
            @else
                <span class="px-3 py-1 text-slate-300 cursor-not-allowed"><span class="material-symbols-outlined text-sm">chevron_right</span></span>
            @endif
        </div>
        @endif
    </div>
</div>

@endsection
