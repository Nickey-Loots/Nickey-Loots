<x-guest-layout>
    <section class="max-w-md mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-900 dark:text-white">Registreren</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-800 dark:text-gray-200">Naam</label>
                <x-text-input id="name" name="name" type="text" required autofocus
                    class="mt-1 block w-full dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="email"
                    class="block text-sm font-medium text-gray-800 dark:text-gray-200">E-mailadres</label>
                <x-text-input id="email" name="email" type="email" required
                    class="mt-1 block w-full dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password"
                    class="block text-sm font-medium text-gray-800 dark:text-gray-200">Wachtwoord</label>
                <x-text-input id="password" name="password" type="password" required
                    class="mt-1 block w-full dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation"
                    class="block text-sm font-medium text-gray-800 dark:text-gray-200">Bevestig wachtwoord</label>
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                    class="mt-1 block w-full dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-primary-button class="w-full justify-center">
                Registreren
            </x-primary-button>
        </form>
    </section>
</x-guest-layout>
