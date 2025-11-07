<!-- Left Sidebar Component -->
<div class="hidden sm:flex sm:flex-col sm:w-64 sm:fixed sm:h-screen sm:shadow-lg">
    <!-- Sidebar Header -->
    <div class="flex-1 flex flex-col min-h-0 bg-white">
        <!-- Logo and Brand -->
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <a href="#" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 2C8.28 2 2 8.28 2 16s6.28 14 14 14 14-6.28 14-14S23.72 2 16 2zm0 26C9.38 28 4 22.63 4 16S9.38 4 16 4s12 5.38 12 12-5.38 12-12 12zm0-24C10.84 4 8 6.84 8 10s2.84 6 6 6 6-2.84 6-6-2.84-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="currentColor"/>
                    </svg>
                    <span class="text-xl font-bold text-gray-800">Theme<span class="text-indigo-600">Builder</span></span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="mt-5 px-2 space-y-1">
                <!-- Home -->
                <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-900 bg-indigo-100">
                    <svg class="mr-3 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </a>

                <!-- Themes -->
                <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50 hover:text-gray-900">
                    <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Themes
                </a>

                <!-- Settings -->
                <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50 hover:text-gray-900">
                    <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </a>
            </nav>

            <!-- Profile Section -->
            <div class="mt-8 flex-shrink-0 flex border-t border-gray-200 px-4">
                <a href="#" class="group block flex-shrink-0">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-10 w-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">John Doe</p>
                            <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">View profile</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main content area -->
<div class="sm:pl-64">
    <div class="h-16 flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 bg-white">
        <div class="flex-1 min-w-0">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <button type="button" class="inline-flex items-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:hidden" id="sidebar-toggle">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 px-4 flex justify-between sm:px-6">
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-gray-900 truncate">Dashboard</h2>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <!-- Notification Icon -->
                        <button type="button" class="p-1 rounded-full text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content area -->
    <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
        <!-- Content will be added here -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <!-- Content will be added here -->
        </div>
    </main>
</div>
{{-- can access by : <x-sidebar /> --}}

<!-- Add this script to handle sidebar toggle -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sm:w-64');
    const mainContent = document.querySelector('.sm:pl-64');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
        mainContent.classList.toggle('pl-64');
        mainContent.classList.toggle('pl-16');
    });
});
</script>
