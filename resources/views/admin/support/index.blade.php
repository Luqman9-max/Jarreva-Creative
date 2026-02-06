@extends('admin.layouts.app')

@section('title', 'Support - Jarreva Creative Admin')

@section('header_title', 'Help & Support')
@section('header_subtitle', 'Find answers to common questions or contact support.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Left Column: Contact & Quick Links --}}
    <div class="lg:col-span-1 space-y-6">
        
        {{-- Contact Card --}}
        <div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">Contact Support</h3>
            <div class="space-y-4">
                <div class="flex items-start gap-4 p-3 rounded-xl bg-orange-50 hover:bg-orange-100 transition-colors">
                    <div class="p-2 bg-white rounded-lg shadow-sm text-primary">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Email Us</p>
                        <a href="mailto:support@jarreva.com" class="text-sm font-bold text-slate-800 hover:text-primary transition-colors">support@jarreva.com</a>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors">
                    <div class="p-2 bg-white rounded-lg shadow-sm text-blue-600">
                        <span class="material-symbols-outlined">call</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Call Us</p>
                        <a href="tel:+6281234567890" class="text-sm font-bold text-slate-800 hover:text-blue-600 transition-colors">+62 812 3456 7890</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Documentation Links --}}
         <div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">Documentation</h3>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 text-slate-600 hover:text-primary transition-colors group">
                        <span class="text-sm font-medium">Platform Overview</span>
                        <span class="material-symbols-outlined text-[18px] text-slate-300 group-hover:text-primary">arrow_forward</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 text-slate-600 hover:text-primary transition-colors group">
                         <span class="text-sm font-medium">Managing Books</span>
                        <span class="material-symbols-outlined text-[18px] text-slate-300 group-hover:text-primary">arrow_forward</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 text-slate-600 hover:text-primary transition-colors group">
                         <span class="text-sm font-medium">Admin Roles</span>
                        <span class="material-symbols-outlined text-[18px] text-slate-300 group-hover:text-primary">arrow_forward</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Right Column: FAQs --}}
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Frequently Asked Questions</h3>
                <p class="text-sm text-slate-500 mt-1">Common answers to questions about the admin panel.</p>
            </div>
            
            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                <!-- FAQ Item 1 -->
                <div class="group">
                    <button class="w-full text-left p-6 md:p-8 focus:outline-none flex justify-between items-start gap-4">
                        <span class="font-bold text-slate-800 dark:text-gray-200 group-hover:text-primary transition-colors">How do I add a new administrator?</span>
                        <span class="material-symbols-outlined text-slate-400">expand_more</span>
                    </button>
                    <div class="px-6 md:px-8 pb-6 hidden group-focus-within:block text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                        To add a new administrator, navigate to the <a href="{{ route('admin.admins.index') }}" class="text-primary hover:underline">Admins</a> page and click the "Add Admin" button. Fill in their name, email, and password. You can also upload a profile photo for them.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="group">
                    <button class="w-full text-left p-6 md:p-8 focus:outline-none flex justify-between items-start gap-4">
                        <span class="font-bold text-slate-800 dark:text-gray-200 group-hover:text-primary transition-colors">How do I reset my password?</span>
                        <span class="material-symbols-outlined text-slate-400">expand_more</span>
                    </button>
                    <div class="px-6 md:px-8 pb-6 hidden group-focus-within:block text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                        You can change your password in the <a href="{{ route('admin.settings.index') }}" class="text-primary hover:underline">Settings</a> page. Enter your current password and your new password twice to confirm. If you've forgotten your password completely, please contact a super administrator to reset it for you.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="group">
                     <button class="w-full text-left p-6 md:p-8 focus:outline-none flex justify-between items-start gap-4">
                        <span class="font-bold text-slate-800 dark:text-gray-200 group-hover:text-primary transition-colors">Can I delete a book that has been published?</span>
                        <span class="material-symbols-outlined text-slate-400">expand_more</span>
                    </button>
                    <div class="px-6 md:px-8 pb-6 hidden group-focus-within:block text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                        Yes, you can delete any book. However, it is recommended to unpublish (move to Draft) books instead of deleting them if you might need the data later. Verification prompts will appear before permanent deletion.
                    </div>
                </div>
                 <!-- FAQ Item 4 -->
                <div class="group">
                     <button class="w-full text-left p-6 md:p-8 focus:outline-none flex justify-between items-start gap-4">
                        <span class="font-bold text-slate-800 dark:text-gray-200 group-hover:text-primary transition-colors">What formats are supported for book covers?</span>
                        <span class="material-symbols-outlined text-slate-400">expand_more</span>
                    </button>
                    <div class="px-6 md:px-8 pb-6 hidden group-focus-within:block text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                        The system supports standard image formats including JPG, PNG, and GIF. The maximum recommended file size is 2MB for optimal performance.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Simple Accordion Script --}}
@section('scripts')
<script>
    document.querySelectorAll('.group button').forEach(button => {
        button.addEventListener('click', () => {
             const content = button.nextElementSibling;
             content.classList.toggle('hidden');
             const icon = button.querySelector('.material-symbols-outlined');
             icon.textContent = content.classList.contains('hidden') ? 'expand_more' : 'expand_less';
        });
    });
</script>
@endsection

@endsection
