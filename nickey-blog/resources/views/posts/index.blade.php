@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">
            Welkom op onze Blog
        </h1>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition hover:shadow-lg p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold mb-3 text-gray-900 dark:text-white">
                            {{ $post->title }}
                        </h2>
                        <p class="text-base text-gray-800 dark:text-gray-200 leading-relaxed mb-4">
                            {{ Str::limit(strip_tags($post->body), 120) }}
                        </p>
                    </div>

                    <div class="mt-auto">
                        <a href="{{ route('posts.show', $post) }}"
                            class="inline-block text-blue-600 dark:text-blue-400 font-medium hover:underline">
                            Lees meer →
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-gray-600 dark:text-gray-300 col-span-3 text-center">
                    Er zijn nog geen blogposts.
                </p>
            @endforelse
        </div>
    </section>
@endsection
