<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-gray-400 overflow-hidden sm:rounded-lg">
        <div class="flex justify-center mb-12">
            <img src="{{ asset('images/smk.png') }}" alt="Logo" class="h-20 w-auto">
        </div>

        <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">
            Selamat Datang Kembali
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6"onsubmit="return confirm('selamat anda berhasil login')">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-black" />
                <div class="mt-1">
                    <x-text-input 
                        id="email" 
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
                <div class="mt-1">
                    <x-text-input 
                        id="password" 
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <x-primary-button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
