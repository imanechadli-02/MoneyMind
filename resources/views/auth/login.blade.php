<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-500 dark:from-emerald-900 dark:via-emerald-800 dark:to-emerald-900 p-6">
        <div class="relative">
            <!-- Decorative elements -->
            <div class="absolute -top-20 -left-20 w-40 h-40 bg-emerald-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-emerald-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-16 -left-16 w-36 h-36 bg-emerald-600 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>

            <!-- Login Card -->
            <div class="relative bg-white/80 dark:bg-emerald-700/80 backdrop-blur-xl rounded-3xl shadow-2xl w-full max-w-md overflow-hidden">
                <!-- Brand Header -->
                <div class="px-8 pt-10 pb-6">
                    <div class="text-center space-y-2">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-tr from-emerald-600 to-emerald-800 mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-800 bg-clip-text text-transparent">
                            Bienvenue
                        </h2>
                        <p class="text-emerald-500 dark:text-emerald-400">
                            Connectez-vous à votre compte
                        </p>
                    </div>
                </div>

                <div class="p-8 pt-0">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Input -->
                        <div class="space-y-2">
                            <x-input-label for="email" :value="__('Adresse Email')" 
                                class="text-sm font-medium text-emerald-700 dark:text-emerald-300" />
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-xl blur opacity-20 group-hover:opacity-30 transition duration-200"></div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-emerald-400 group-hover:text-emerald-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                    <x-text-input id="email" name="email" :value="old('email')" type="email"
                                        class="block w-full pl-12 pr-4 py-3 bg-white dark:bg-emerald-700 border border-emerald-200 dark:border-emerald-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-emerald-700 dark:text-emerald-300 transition-all duration-200"
                                        placeholder="exemple@email.com" required autofocus autocomplete="username" />
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password Input -->
                        <div class="space-y-2">
                            <x-input-label for="password" :value="__('Mot de passe')" 
                                class="text-sm font-medium text-emerald-700 dark:text-emerald-300" />
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-xl blur opacity-20 group-hover:opacity-30 transition duration-200"></div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-emerald-400 group-hover:text-emerald-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <x-text-input id="password" name="password" type="password"
                                        class="block w-full pl-12 pr-4 py-3 bg-white dark:bg-emerald-700 border border-emerald-200 dark:border-emerald-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-emerald-700 dark:text-emerald-300 transition-all duration-200"
                                        placeholder="Votre mot de passe" required autocomplete="current-password" />
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="remember"
                                    class="w-4 h-4 border-emerald-300 rounded text-emerald-600 focus:ring-emerald-500 transition duration-200">
                                <span class="text-sm text-emerald-600 dark:text-emerald-400">Se souvenir de moi</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition duration-200">
                                    Mot de passe oublié?
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <div>
                            <button type="submit" 
                                class="w-full py-3 px-4 bg-gradient-to-r from-emerald-600 to-emerald-800 hover:from-emerald-700 hover:to-emerald-900 text-white font-medium rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                                Se connecter
                            </button>
                        </div>
                    </form>

                    <!-- Register Link -->
                    <div class="mt-8 text-center">
                        <p class="text-sm text-emerald-600 dark:text-emerald-400">
                            Pas encore de compte? 
                            <a href="{{ route('register') }}" 
                                class="font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition duration-200">
                                Créer un compte
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-guest-layout>
