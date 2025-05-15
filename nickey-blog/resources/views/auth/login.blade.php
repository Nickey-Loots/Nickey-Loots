<x-guest-layout>
    <section class="max-w-md mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-900 dark:text-white">Inloggen</h1>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email"
                    class="block text-sm font-medium text-gray-800 dark:text-gray-200">E-mailadres</label>
                <x-text-input id="email" type="email" name="email" required autofocus
                    class="mt-1 block w-full dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password"
                    class="block text-sm font-medium text-gray-800 dark:text-gray-200">Wachtwoord</label>
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password"
                    class="mt-1 block w-full dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                    <span class="ml-2 text-sm text-gray-800 dark:text-gray-200">Onthoud mij</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Wachtwoord vergeten?</a>
                @endif
            </div>

            <x-primary-button class="w-full justify-center">
                Inloggen
            </x-primary-button>
        </form>
    </section>
</x-guest-layout>
