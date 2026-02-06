@extends('admin.layouts.app')

@section('title', 'Edit Admin - Jarreva Creative Admin')

@section('header_title', 'Edit Admin')
@section('header_subtitle', 'Update administrator details.')

@section('header_actions')
    <a href="{{ route('admin.admins.index') }}" class="py-2.5 px-4 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-800 hover:border-slate-300 rounded-lg text-sm font-bold shadow-sm hover:shadow transition-all active:scale-95 flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Cancel
    </a>
@endsection

@section('content')

<div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 md:p-8 max-w-2xl">
    <form action="{{ route('admin.admins.update', $admin) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        {{-- Profile Photo --}}
        <div class="space-y-1">
            <label for="profile_photo" class="block text-sm font-semibold text-slate-700 ml-1">Profile Photo</label>
            
            @if($admin->profile_photo_path)
            <div class="mb-2 p-2 bg-slate-50 rounded-lg flex items-center gap-4 w-fit">
                <div class="h-16 w-16 rounded-full bg-cover bg-center ring-2 ring-white shadow-sm" style="background-image: url('{{ asset('storage/' . $admin->profile_photo_path) }}');"></div>
                <div>
                    <p class="text-xs text-slate-500">Current Photo</p>
                    <p class="text-xs font-bold truncate max-w-[150px]">{{ basename($admin->profile_photo_path) }}</p>
                </div>
            </div>
            @endif

            <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:bg-slate-50 transition-colors cursor-pointer relative group">
                <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <div class="space-y-2">
                    <span class="material-symbols-outlined text-[40px] text-slate-300 group-hover:text-primary transition-colors">account_circle</span>
                    <p class="text-sm text-slate-500 font-medium">Click to replace or drag and drop</p>
                    <p class="text-xs text-slate-400">Leave blank to keep current photo</p>
                </div>
            </div>
            @error('profile_photo') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
        </div>

        {{-- Name --}}
        <div class="space-y-1">
            <label for="name" class="block text-sm font-semibold text-slate-700 ml-1">Full Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
            @error('name') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
        </div>

        {{-- Email --}}
        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-slate-700 ml-1">Email Information <span class="text-red-500">*</span></label>
            <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
            @error('email') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2 border-t border-slate-100 mt-2">
            <div class="col-span-2">
                <p class="text-sm font-bold text-slate-800 mb-2">Change Password</p>
                <p class="text-xs text-slate-500 mb-4">Leave blank if you don't want to change the password.</p>
            </div>

            {{-- Password --}}
            <div class="space-y-1">
                <label for="password" class="block text-sm font-semibold text-slate-700 ml-1">New Password</label>
                <input type="password" name="password" id="password" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                @error('password') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 ml-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-primary hover:bg-orange-600 text-white font-bold rounded-lg shadow-lg hover:shadow-orange-500/30 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">save</span>
                Update Admin
            </button>
        </div>
    </form>
</div>
@endsection
