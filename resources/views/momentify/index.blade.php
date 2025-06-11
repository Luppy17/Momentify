<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Momentify') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased h-full bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <!-- Backdrop blur for dark mode toggle transition -->
    <div class="min-h-screen backdrop-blur-sm">
        <!-- Navigation -->
        <nav class="fixed top-0 w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200/80 dark:border-gray-700/80 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="block">
                            <!-- Light mode logo -->
                            <img src="{{ asset('images/momentify.png') }}"
                                 alt="Momentify Logo"
                                 class="h-8 w-auto block dark:hidden">
                            <!-- Dark mode logo -->
                            <img src="{{ asset('images/momentify1.png') }}"
                                 alt="Momentify Logo"
                                 class="h-8 w-auto hidden dark:block">
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        @auth
                            @if(auth()->user()->is_user == 1)
                                <a href="{{ route('momentify.index') }}"
                                   class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Momentify
                                </a>
                            @else
                                <a href="{{ url('/dashboard') }}"
                                   class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Dashboard
                                </a>
                            @endif
                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-sm font-medium bg-gray-900 text-white dark:bg-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors duration-200">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-sm font-medium bg-gray-900 text-white dark:bg-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors duration-200">
                                Log in
                            </a>
                        @endauth

                        <!-- Dark mode toggle -->
                        <button id="theme-toggle" class="p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700">
                            <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                            </svg>
                            <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="sm:hidden mobile-menu hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    @auth
                        @if(auth()->user()->is_user == 1)
                            <a href="{{ route('momentify.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">Momentify</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">Log in</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="pt-16">
            <!-- Hero Section -->
            <div class="relative">
                <div class="relative h-[80vh] overflow-hidden">
                    <!-- Background Image -->
                    <img
                        src="{{ asset('images/waterfall.jpeg') }}"
                        alt="Professional Photography"
                        class="absolute inset-0 w-full h-full object-cover"
                    >

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30">
                        <!-- Content -->
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
                            <div class="flex flex-col justify-center h-full max-w-3xl">
                                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                                    Capture Your Special
                                    <span class="rgb-text">Moments</span>
                                </h1>

                                <p class="text-xl md:text-2xl text-gray-200 mb-8">
                                    Effortless photo search for any occasion using advanced face recognition technology.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    @auth
                                        @if(auth()->user()->is_user == 1)
                                            <a
                                                href="{{ route('momentify.index') }}"
                                                class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-black bg-white hover:bg-gray-100 transition duration-300 ease-in-out"
                                            >
                                                Go to Momentify
                                            </a>
                                        @else
                                            <a
                                                href="{{ url('/dashboard') }}"
                                                class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-black bg-white hover:bg-gray-100 transition duration-300 ease-in-out"
                                            >
                                                Go to Dashboard
                                            </a>
                                        @endif
                                    @else
                                        <a
                                            href="{{ route('register') }}"
                                            class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-black bg-white hover:bg-gray-100 transition duration-300 ease-in-out"
                                        >
                                            Get Started
                                        </a>
                                    @endauth
                                    <a
                                        href="#services"
                                        class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-base font-medium rounded-md text-white hover:bg-white hover:text-black transition duration-300 ease-in-out smooth-scroll"
                                    >
                                        Our Services
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scroll Indicator -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>

           <!-- Services Section -->
            <section id="services" class="py-20 bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Event Collections</h2>
                        <p class="text-lg text-gray-600 dark:text-gray-300">Browse through our event folders and find your memories using face recognition</p>
                    </div>

                    @if($events->isNotEmpty())
                    <!-- Event Folders Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($events as $event)
                        <a href="{{ route('eventdetails.show', $event->id) }}" class="group block bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                            <div class="relative aspect-w-16 aspect-h-9">
                                <img
                                    src="{{ $event->cover_image ? asset('storage/event_covers/' . $event->cover_image) : asset('storage/images/event-default.jpg') }}"
                                    alt="{{ $event->event_name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate" title="{{ $event->event_name }}">{{ $event->event_name }}</h3>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</span>
                                </div>

                                <!-- Event Details -->
                                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400 dark:text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="truncate" title="{{ $event->event_place }}">{{ $event->event_place }}</span>
                                    </div>
                                    <!-- Time -->
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400 dark:text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        <p>No events available at the moment.</p>
                    </div>
                @endif
                </div>
            </section>

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center space-x-4">
                    <!-- Footer Logo -->
                    <a href="{{ url('/') }}" class="block">
                        <img src="{{ asset('images/momentify.png') }}"
                            alt="Momentify Logo"
                            class="h-6 w-auto block dark:hidden">
                        <img src="{{ asset('images/momentify1.png') }}"
                            alt="Momentify Logo"
                            class="h-6 w-auto hidden dark:block">
                    </a>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        © {{ date('Y') }} All rights reserved.
                    </span>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Check initial theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }

        // Theme toggle
        document.getElementById('theme-toggle').addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark')
                localStorage.theme = 'light'
            } else {
                document.documentElement.classList.add('dark')
                localStorage.theme = 'dark'
            }
        })

        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden')
        })

        // Smooth scroll
        document.querySelectorAll('.smooth-scroll').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                document.querySelector(targetId).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
