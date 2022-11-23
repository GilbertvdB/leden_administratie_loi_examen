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
            @include('layouts.leden_navigation')
		
		
            <!-- Page Heading -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
        		<h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            		{{ __('Leden Administratie') }}
        		</h2>
                    </div>
                </header>

		
	    <!-- Page Navigation -->
            <nav class="bg-white shadow">
               @include('layouts.leden_sidenav')
            </nav>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

	    <!-- Page Footer -->
                <footer class="bg-white shadow clear-both">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
        		<h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            		{{ __('Vereniging Leden') }}
        		</h2>
                    </div>
                </footer>
        </div>
    </body>
</html>
