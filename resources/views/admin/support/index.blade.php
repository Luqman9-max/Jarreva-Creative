@extends('admin.layouts.app')

@section('title', 'Support - Jarreva Creative Admin')

@section('header_title', 'Help & Support')
@section('header_subtitle', 'Get help with using the admin panel.')

@section('content')
<div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-8 flex flex-col items-center justify-center min-h-[400px]">
    <div class="size-20 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
        <span class="material-symbols-outlined text-slate-400 text-4xl">help</span>
    </div>
    <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Support Page</h3>
    <p class="text-slate-500 text-center max-w-sm">This page will contain documentation, FAQs, and contact information for support.</p>
</div>
@endsection
