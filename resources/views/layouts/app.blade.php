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
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Mobile Hamburger Button -->
            <button 
                id="sidebar-toggle" 
                data-drawer-target="default-sidebar" 
                data-drawer-toggle="default-sidebar" 
                aria-controls="default-sidebar" 
                type="button" 
                class="fixed z-50 top-4 left-4 inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            >
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
    
            <!-- Sidebar -->
            <aside 
                id="default-sidebar" 
                class="fixed top-0 left-0 z-40 h-screen w-64 transition-transform -translate-x-full sm:translate-x-0"
                aria-label="Sidebar"
            >
                <div class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow-lg">
                    <!-- Logo or Branding -->
                    <div class="flex items-center mb-6 px-4">
                        <span class="text-xl font-bold text-gray-800 dark:text-white">Perpustakaan</span>
                    </div>
    
                    <!-- Main Navigation -->
                    <ul class="space-y-2">
                        <!-- Dashboard/Home -->
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                                <span class="ml-3">Beranda</span>
                            </a>
                        </li>
    
                        <!-- Admin Specific Sections -->
                        @if (Auth::user()->role == 'admin')
                            <!-- Book Management -->
                            <li x-data="{ open: false }">
                                <button 
                                    @click="open = !open" 
                                    class="w-full flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                                >
                                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="flex-1 ml-3 text-left">Lemari</span>
                                    <svg class="w-6 h-6" :class="{ 'transform rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul x-show="open" class="py-2 space-y-2 pl-4">
                                    <li>
                                        <a href="{{ route('book.create') }}" class="block p-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Tambah Buku
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('book.index') }}   " class="block p-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Lemari Buku
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.riwayat') }}" class="block p-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Riwayat Pinjam Buku
                                        </a>
                                    </li>
                                </ul>
                            </li>
    
                            <!-- User Management -->
                            <li x-data="{ open: false }">
                                <button 
                                    @click="open = !open" 
                                    class="w-full flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                                >
                                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="flex-1 ml-3 text-left">Users</span>
                                    <svg class="w-6 h-6" :class="{ 'transform rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul x-show="open" class="py-2 space-y-2 pl-4">
                                    <li>
                                        <a href="{{ route('user.index') }}" class="block p-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Anggota
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
    
                        <!-- Member Specific Sections -->
                        @if (Auth::user()->role == 'anggota')
                            <li x-data="{ open: false }">
                                <button 
                                    @click="open = !open" 
                                    class="w-full flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                                >
                                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="flex-1 ml-3 text-left">Lemari</span>
                                    <svg class="w-6 h-6" :class="{ 'transform rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul x-show="open" class="py-2 space-y-2 pl-4">
                                    <li>
                                        <a href="{{ route('anggota.index') }}" class="block p-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Lemari Buku
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('anggota.riwayat') }}" class="block p-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Riwayat Pinjam Buku
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
    
                    <!-- Footer Navigation -->
                    <div class="absolute bottom-0 left-0 w-full border-t border-gray-200 dark:border-gray-700 pt-4 pb-4">
                        <ul class="space-y-2 px-3">
                            <li>
                                <!-- Logout -->
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 512 512">
                                            <path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/>
                                        </svg>
                                        <span class="ml-3 text-red-500">Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
    
            <!-- Main Content Area -->
            <div class="sm:ml-64 p-4">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow mb-4">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset
    
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    
        <!-- Optional Alpine.js for dropdown interactions -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        
        <!-- Mobile Sidebar Toggle Script -->
        <script>
            document.getElementById('sidebar-toggle').addEventListener('click', function() {
                const sidebar = document.getElementById('default-sidebar');
                sidebar.classList.toggle('-translate-x-full');
            });
        </script>
    </body>
</html>
