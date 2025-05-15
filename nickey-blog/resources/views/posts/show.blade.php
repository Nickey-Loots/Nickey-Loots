@extends('layouts.app')

@section('content')
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-300 mb-6">
            {{ $post->title }}
        </h1>

        <div class="text-lg leading-relaxed text-gray-800 dark:text-gray-300 space-y-4">
            {!! nl2br(e($post->body)) !!}
        </div>

        <div class="mt-10">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-medium transition dark:text-gray-400">
                &larr; Terug naar blog
            </a>
        </div>
    </section>
@endsection
