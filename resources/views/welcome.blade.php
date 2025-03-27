<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MoneyMind</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700|plus-jakarta-sans:400,500,600,700" rel="stylesheet" />

    <!-- Animation libraries -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(135deg, #2563eb, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: translateY(-5px);
        }
        .animated-gradient {
            background: linear-gradient(270deg, #2563eb, #4f46e5, #7c3aed);
            background-size: 200% 200%;
            animation: gradientAnimation 6s ease infinite;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }
    </style>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body
    class="bg-[#fafafa] dark:bg-gray-900 text-gray-800 flex p-6 lg:pt-8 lg:p-0 items-center lg:justify-center min-h-screen flex-col">
    <!-- Animated background shapes -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 glass-card mx-4 mt-4 lg:mx-auto lg:max-w-6xl rounded-2xl shadow-lg">
        @if (Route::has('login'))
            <nav class="flex items-center justify-between px-6 py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">M</span>
                    </div>
                    <a href="{{ url('/') }}" class="text-2xl font-bold gradient-text">
                        MoneyMind
                    </a>
                </div>
                
                <!-- Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-blue-600 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-gray-600 hover:text-blue-600 transition-colors">How it Works</a>
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-2.5 animated-gradient text-white rounded-xl hover:shadow-lg transition-all duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-blue-600 transition-colors">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-6 py-2.5 animated-gradient text-white rounded-xl hover:shadow-lg transition-all duration-300">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif
    </header>
    {{-- ***************************************************** --}}

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 px-4 sm:px-6 overflow-hidden max-w-7xl mx-auto w-full">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <!-- Text Content -->
            <div data-aos="fade-right" data-aos-duration="1000" class="text-center md:text-left">
                <div class="inline-block px-4 py-1.5 rounded-full bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 mb-6">
                    <span class="text-sm font-medium gradient-text">✨ La gestion financière intelligente</span>
                </div>
                <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                    Gérez votre budget <span class="gradient-text">intelligemment</span> avec l'IA
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                    Simplifiez votre gestion financière avec des suggestions personnalisées et un suivi automatique
                    de vos dépenses. Notre IA vous aide à prendre de meilleures décisions financières.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="/register"
                        class="group px-8 py-4 animated-gradient text-white rounded-xl transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/20 flex items-center justify-center">
                        Commencer gratuitement
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="#demo"
                        class="px-8 py-4 border-2 border-blue-600 text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Voir la démo
                    </a>
                </div>
            </div>

            <!-- Image/Animation Content -->
            <div data-aos="fade-left" data-aos-duration="1000" class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-3xl transform rotate-6 blur-xl opacity-30"></div>
                <div class="relative glass-card rounded-3xl p-6 shadow-xl">
                    {{-- <img src="{{ asset('images/logo_2.png') }}" alt="Dashboard Preview"
                        class="rounded-xl shadow-2xl w-full h-auto object-cover">
                     --}}
                    <!-- Floating Stats Cards -->
                    <div class="absolute -right-6 -bottom-6 glass-card rounded-xl p-4 shadow-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Économies</p>
                                <p class="text-lg font-bold gradient-text">+27%</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -left-6 top-1/3 glass-card rounded-xl p-4 shadow-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Analyse IA</p>
                                <p class="text-lg font-bold gradient-text">En temps réel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative py-20 glass-card my-20 mx-4 lg:mx-auto max-w-7xl rounded-3xl">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="px-4 py-1.5 rounded-full bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 text-sm font-medium gradient-text">
                    Fonctionnalités
                </span>
                <h2 class="text-4xl font-bold mt-4 gradient-text">Des outils puissants pour vos finances</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature Cards -->
                <div data-aos="fade-up" data-aos-delay="100"
                    class="glass-card p-6 rounded-2xl transition-all duration-300 hover:shadow-xl group">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 group-hover:gradient-text transition-colors">Suivi Automatique</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Gestion automatisée des salaires et dépenses récurrentes pour un contrôle sans effort de vos finances.
                    </p>
                </div>

                <!-- Add more feature cards with similar styling -->
            </div>
        </div>
    </section>

    <!-- How it works Section -->
    <section id="how-it-works" class="relative py-20 glass-card my-20 mx-4 lg:mx-auto max-w-7xl rounded-3xl overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="px-4 py-1.5 rounded-full bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 text-sm font-medium gradient-text">
                    Guide
                </span>
                <h2 class="text-4xl font-bold mt-4 gradient-text">Comment ça marche</h2>
            </div>

            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full animated-gradient rounded-full hidden md:block"></div>

                <!-- Timeline items -->
                <div class="grid grid-cols-1 gap-12 relative z-10">
                    <div data-aos="fade-right" class="relative flex items-center justify-end md:justify-start md:even:justify-end group">
                        <div class="w-full md:w-5/12 glass-card p-6 rounded-2xl transition-all duration-300 hover:shadow-xl">
                            <span class="inline-block px-3 py-1 rounded-full bg-gradient-to-r from-blue-50 to-indigo-50 text-sm font-medium gradient-text mb-4">
                                Étape 1
                            </span>
                            <h3 class="text-xl font-semibold mb-3">Créez votre compte</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                Inscrivez-vous en quelques clics et configurez votre profil financier avec votre salaire mensuel.
                            </p>
                        </div>
                    </div>
                    <!-- Add more timeline items -->
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="w-full glass-card mt-auto rounded-t-3xl">
        <div class="max-w-7xl mx-auto py-8 px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">M</span>
                    </div>
                    <span class="gradient-text font-semibold">MoneyMind</span>
                </div>
                <div class="text-gray-600 dark:text-gray-300 text-sm">
                    © 2024 MoneyMind. Tous droits réservés.
                </div>
            </div>
        </div>
    </footer>

    {{-- ***************************************************** --}}

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

    {{-- ***************************************************** --}}
    <!-- Initialize AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
        });
    </script>

    <!-- Add this script at the end of your body tag -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuClosedIcon = document.getElementById('menu-closed-icon');
            const menuOpenIcon = document.getElementById('menu-open-icon');

            mobileMenu.classList.toggle('hidden');
            menuClosedIcon.classList.toggle('hidden');
            menuOpenIcon.classList.toggle('hidden');
        }

        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.add('hidden');
                document.getElementById('menu-closed-icon').classList.remove('hidden');
                document.getElementById('menu-open-icon').classList.add('hidden');
            });
        });

        // Close mobile menu when scrolling
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > lastScroll) {
                document.getElementById('mobile-menu').classList.add('hidden');
                document.getElementById('menu-closed-icon').classList.remove('hidden');
                document.getElementById('menu-open-icon').classList.add('hidden');
            }
            lastScroll = currentScroll;
        });
    </script>
    {{-- ***************************************************** --}}

</body>

</html>
