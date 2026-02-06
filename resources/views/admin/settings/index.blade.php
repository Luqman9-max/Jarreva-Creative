@extends('admin.layouts.app')

@section('title', 'Settings - Jarreva Creative Admin')

@section('header_title', 'Account Settings')
@section('header_subtitle', 'Manage your profile information and security.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Left Column: Profile Card --}}
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 flex flex-col items-center text-center">
            <div class="relative group mb-4">
                @if($admin->profile_photo_path)
                    <div class="size-32 rounded-full bg-cover bg-center ring-4 ring-slate-50 dark:ring-slate-700 shadow-md" style="background-image: url('{{ asset('storage/' . $admin->profile_photo_path) }}');"></div>
                @else
                    <div class="size-32 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-4xl font-bold ring-4 ring-slate-50 dark:ring-slate-700 shadow-md">
                        {{ substr($admin->name, 0, 2) }}
                    </div>
                @endif
                <div class="absolute bottom-0 right-0 bg-green-500 w-6 h-6 rounded-full border-4 border-white dark:border-[#1e293b]"></div>
            </div>
            
            <h3 class="text-xl font-bold text-slate-800 dark:text-white">{{ $admin->name }}</h3>
            <p class="text-slate-500 text-sm font-medium mb-4">{{ $admin->email }}</p>
            
            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                Administrator
            </div>
        </div>

        {{-- Verification Status (Mock) --}}
        <div class="bg-blue-50 dark:bg-blue-900/10 rounded-2xl p-6 border border-blue-100 dark:border-blue-900/20">
            <div class="flex items-start gap-4">
                <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                    <span class="material-symbols-outlined">verified_user</span>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 dark:text-blue-100 mb-1">Account Verified</h4>
                    <p class="text-xs text-blue-700 dark:text-blue-300 leading-relaxed">Your administrator account is fully verified and has full access to all system features.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Column: Forms --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Profile Information --}}
        <div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 md:p-8">
            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-100 dark:border-slate-800">
                <span class="material-symbols-outlined text-slate-400">person</span>
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Profile Information</h3>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-semibold text-slate-700 ml-1">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                        @error('name') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-semibold text-slate-700 ml-1">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                        @error('email') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Profile Photo Upload --}}
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 ml-1">Update Profile Photo</label>
                    <div class="flex items-center gap-4">
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-4 w-full flex-1 text-center hover:bg-slate-50 transition-colors cursor-pointer relative group">
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="space-y-1">
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">cloud_upload</span>
                                <p class="text-xs text-slate-500 font-medium">Click to upload new photo</p>
                            </div>
                        </div>
                    </div>
                     @error('profile_photo') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                </div>
                
                {{-- Preview Container --}}
                <div class="preview-container hidden mb-2">
                     <p class="text-xs font-semibold text-slate-500 mb-2 ml-1">New Photo Preview:</p>
                     <div class="relative w-fit">
                        <img src="" class="h-20 w-20 rounded-full shadow-sm border border-slate-200 object-cover">
                         <button type="button" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 shadow-md hover:bg-red-600 transition-colors remove-image">
                            <span class="material-symbols-outlined text-[12px]">close</span>
                        </button>
                    </div>
                </div>

                <div class="border-t border-slate-100 dark:border-slate-800 pt-6 mt-6">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-slate-400">lock</span>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Security & Password</h3>
                    </div>
                    
                    <div class="space-y-6">
                         <div class="space-y-1">
                            <label for="current_password" class="block text-sm font-semibold text-slate-700 ml-1">Current Password <span class="text-xs font-normal text-slate-400">(Leave blank if not changing)</span></label>
                            <input type="password" name="current_password" id="current_password" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                             @error('current_password') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label for="new_password" class="block text-sm font-semibold text-slate-700 ml-1">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                                @error('new_password') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-1">
                                <label for="new_password_confirmation" class="block text-sm font-semibold text-slate-700 ml-1">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="w-full md:w-auto px-8 py-3 bg-primary hover:bg-orange-600 text-white font-bold rounded-lg shadow-lg hover:shadow-orange-500/30 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Image Preview Logic for Settings
        const input = document.getElementById('profile_photo');
        if (!input) return;

        const previewContainer = document.querySelector('.preview-container');
        const previewImage = previewContainer.querySelector('img');
        const removeButton = previewContainer.querySelector('.remove-image');

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        removeButton.addEventListener('click', function() {
            input.value = '';
            previewImage.src = '';
            previewContainer.classList.add('hidden');
        });
    });
</script>
@endsection

@endsection
