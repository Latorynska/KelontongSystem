<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Sidenav -->
            <div id="docs-sidenav" class="w-64 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6">
                    <a class="flex-none text-xl font-semibold dark:text-white" href="#" aria-label="Brand">Brand</a>
                </div>
                <nav class="hs-accordion-group p-2 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                    <ul class="space-y-2.5">
                        <x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Dashboard
                        </x-side-nav-link>
                        <li class="hs-accordion" id="projects-accordion">
                            <button type="button" class="hs-accordion-toggle hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent w-full text-start flex items-center gap-x-3.5 py-3 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:hs-accordion-active:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                <svg class="w-4 h-4" xmlns="ƒhttp://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.5 2H8.6c-.4 0-.8.2-1.1.5-.3.3-.5.7-.5 1.1v12.8c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h9.8c.4 0 .8-.2 1.1-.5.3-.3.5-.7.5-1.1V6.5L15.5 2z"/><path d="M3 7.6v12.8c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h9.8"/><path d="M15 2v5h5"/></svg>
                                Projects

                                <svg class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>

                                <svg class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                </svg>
                            </button>

                            <div id="projects-accordion" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                                <ul class="pt-2 ps-2">
                                    <x-side-nav-link :href="route('dashboard')" :active="false">Link 1</x-side-nav-link>
                                    <x-side-nav-link :href="route('dashboard')" :active="false">Link 2</x-side-nav-link>
                                    <x-side-nav-link :href="route('dashboard')" :active="false">Link 3</x-side-nav-link>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </nav>
            </div>
    
            <!-- Main Content -->
            <div class="flex-1 min-h-screen">
                <!-- Navigation Toggle -->
                {{-- <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#docs-sidenav" aria-controls="docs-sidenav" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle Navigation</span>
                    <svg class="flex-shrink-0 w-4 h-4" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button> --}}
                <!-- End Navigation Toggle -->
    
                @include('layouts.navigation')
    
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
    
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
    
</html>
