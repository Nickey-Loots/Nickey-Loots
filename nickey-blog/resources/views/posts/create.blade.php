@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Beheer Blogposts</h1>

        <a href="{{ route('posts.create') }}"
            class="inline-block mb-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Nieuwe Post
        </a>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <div class="bg-white dark:bg-gray-300 rounded shadow p-5 space-y-3">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $post->title }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ Str::limit(strip_tags($post->body), 100) }}</p>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-600">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                            Bekijken
                        </a>

                        <div class="flex space-x-3">
                            <a href="{{ route('posts.edit', $post) }}"
                                class="text-yellow-600 dark:text-yellow-400 hover:underline">
                                Bewerken
                            </a>

                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Weet je zeker?')"
                                    class="text-red-600 dark:text-red-400 hover:underline">
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400 col-span-3 text-center">
                    Er zijn nog geen blogposts.
                </p>
            @endforelse
        </div>
    </section>
@endsection
