@extends('layouts.app')

@section('content')
    <section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Bewerk Blogpost</h1>

        <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1 text-gray-800 dark:text-gray-200">Titel</label>
                <input type="text" name="title" required value="{{ old('title', $post->title) }}"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1 text-gray-800 dark:text-gray-200">Inhoud</label>
                <textarea name="body" rows="8" required
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body', $post->body) }}</textarea>
            </div>

            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">
                Bijwerken
            </button>
        </form>
    </section>
@endsection
