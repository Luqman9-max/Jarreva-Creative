@extends('admin.layouts.app')

@section('title', 'Edit Book - Jarreva Creative Admin')

@section('header_title', 'Edit Book')
@section('header_subtitle', 'Update book details.')

@section('header_actions')
    <a href="{{ route('admin.books.index') }}" class="py-2.5 px-4 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-800 hover:border-slate-300 rounded-lg text-sm font-bold shadow-sm hover:shadow transition-all active:scale-95 flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Cancel
    </a>
@endsection

@section('content')

<div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 md:p-8">
    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Title --}}
            <div class="space-y-1">
                <label for="title" class="block text-sm font-semibold text-slate-700 ml-1">Book Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                @error('title') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
            </div>

            {{-- Slug --}}
            <div class="space-y-1">
                <label for="slug" class="block text-sm font-semibold text-slate-700 ml-1">Slug <span class="text-red-500">*</span></label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $book->slug) }}" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                @error('slug') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Description (Rich Text Editor) --}}
        <div class="space-y-1">
            <label for="description" class="block text-sm font-semibold text-slate-700 ml-1">Description <span class="text-red-500">*</span></label>
            
            <div class="rich-editor border border-slate-200 rounded-lg overflow-hidden bg-white hover:border-slate-300 focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all">
                <!-- Toolbar -->
                <div class="flex items-center gap-1 p-2 border-b border-slate-100 bg-slate-50/50">
                    <button type="button" data-command="bold" class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-200 rounded transition-colors" title="Bold">
                        <span class="material-symbols-outlined text-[20px]">format_bold</span>
                    </button>
                    <button type="button" data-command="italic" class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-200 rounded transition-colors" title="Italic">
                        <span class="material-symbols-outlined text-[20px]">format_italic</span>
                    </button>
                    <button type="button" data-command="underline" class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-200 rounded transition-colors" title="Underline">
                        <span class="material-symbols-outlined text-[20px]">format_underlined</span>
                    </button>
                    <div class="w-px h-4 bg-slate-300 mx-1"></div>
                    <button type="button" data-command="insertUnorderedList" class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-200 rounded transition-colors" title="Bullet List">
                        <span class="material-symbols-outlined text-[20px]">format_list_bulleted</span>
                    </button>
                    <button type="button" data-command="createLink" class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-200 rounded transition-colors" title="Insert Link">
                        <span class="material-symbols-outlined text-[20px]">link</span>
                    </button>
                </div>
                
                <!-- Editable Area -->
                <div class="editor-content p-4 min-h-[150px] max-h-[400px] outline-none text-slate-800 text-sm overflow-y-auto prose prose-sm max-w-none" contenteditable="true" placeholder="Write a comprehensive description..."></div>
                
                <!-- Hidden Input -->
                <textarea name="description" id="description" class="hidden" required>{{ old('description', $book->description) }}</textarea>
            </div>
            @error('description') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Author Removed --}}

            {{-- Year --}}
            <div class="space-y-1">
                <label for="year" class="block text-sm font-semibold text-slate-700 ml-1">Year</label>
                <input type="number" name="year" id="year" value="{{ old('year', $book->year) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                @error('year') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
            </div>

            {{-- Category --}}
            <div class="space-y-1">
                <label for="category" class="block text-sm font-semibold text-slate-700 ml-1">Category</label>
                <input type="text" name="category" id="category" value="{{ old('category', $book->category) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block p-3 outline-none transition-all">
                @error('category') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Cover Image --}}
        <div class="space-y-1">
            <label for="cover_image" class="block text-sm font-semibold text-slate-700 ml-1">Cover Image</label>
            
            @if($book->cover_image)
            <div class="mb-2 p-2 bg-slate-50 rounded-lg flex items-center gap-4 w-fit">
                <div class="h-16 w-12 rounded bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $book->cover_image) }}');"></div>
                <div>
                    <p class="text-xs text-slate-500">Current Image</p>
                    <p class="text-xs font-bold truncate max-w-[150px]">{{ basename($book->cover_image) }}</p>
                </div>
            </div>
            @endif

            <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:bg-slate-50 transition-colors cursor-pointer relative group">
                <input type="file" name="cover_image" id="cover_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <div class="space-y-2">
                    <span class="material-symbols-outlined text-[40px] text-slate-300 group-hover:text-primary transition-colors">cloud_upload</span>
                    <p class="text-sm text-slate-500 font-medium">Click to replace or drag and drop</p>
                    <p class="text-xs text-slate-400">Leave blank to keep current image</p>
                </div>
            </div>
            @error('cover_image') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
        </div>

        {{-- Toggles --}}
        <div class="flex gap-8 border-t border-slate-100 pt-6">
            <label class="inline-flex items-center cursor-pointer">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" class="sr-only peer" {{ old('is_published', $book->is_published) ? 'checked' : '' }}>
                <div class="relative w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                <span class="ms-3 text-sm font-medium text-slate-700">Published</span>
            </label>

            <label class="inline-flex items-center cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $book->is_featured) ? 'checked' : '' }}>
                <div class="relative w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                <span class="ms-3 text-sm font-medium text-slate-700">Featured</span>
            </label>
        </div>

        <div class="pt-4 flex gap-4">
            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-primary hover:bg-orange-600 text-white font-bold rounded-lg shadow-lg hover:shadow-orange-500/30 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">save</span>
                Update Book
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Rich Text Editor Logic
    document.querySelectorAll('.rich-editor').forEach(editor => {
        const content = editor.querySelector('.editor-content');
        const textarea = editor.querySelector('textarea');
        const buttons = editor.querySelectorAll('button[data-command]');

        // Initialize content from hidden textarea
        if (textarea.value) {
            content.innerHTML = textarea.value;
        }

        // Toolbar Actions
        buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const command = btn.dataset.command;
                
                if (command === 'createLink') {
                    const url = prompt('Enter link URL:', 'http://');
                    if (url) document.execCommand(command, false, url);
                } else {
                    document.execCommand(command, false, null);
                }
                
                // Sync immediately
                textarea.value = content.innerHTML;
            });
        });

        // Sync content to textarea on input
        content.addEventListener('input', () => {
            textarea.value = content.innerHTML;
        });

        // Focus styling
        content.addEventListener('focus', () => {
            editor.classList.add('ring-2', 'ring-primary/20', 'border-primary');
        });
        content.addEventListener('blur', () => {
            editor.classList.remove('ring-2', 'ring-primary/20', 'border-primary');
        });
    });
</script>
@endsection
