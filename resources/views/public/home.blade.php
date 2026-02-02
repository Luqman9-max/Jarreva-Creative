{{-- Landing page --}}
@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Showcase Buku')

@section('content')
    @include('public.components.hero')
    
    <section class="books-grid">
        <!-- TODO: Loop through books -->
    </section>
@endsection
