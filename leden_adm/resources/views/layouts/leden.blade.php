<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Vereniging Leden') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
        	
        		
            <!-- Page Heading -->
                <header class="bg-white shadow flex flex-row">
                    <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-16 w-auto fill-current text-gray-600" />
                    </a>
                </div>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center grow">
        		<h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            		{{ __('Leden Administratie') }}
        		</h2>
                    </div>
                    
                    <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-start sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
                    
                </header>

		
	    <!-- Page Side Navigation -->
            <nav class="bg-white shadow">
               @include('layouts.leden_sidenav')
            </nav>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

	    <!-- Page Footer -->
                <footer class="bg-white shadow clear-both">
                	@include('layouts.footer')
                </footer>
        </div>
        <!-- Tailwind Flowbite plug-in for modals -->
        <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    </body>
</html>
