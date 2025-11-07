<!-- Classic Footer -->
<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 py-8">
            <!-- Company Info -->
            <div class="md:col-span-1">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Theme Builder</h3>
                <p class="text-gray-500">
                    A powerful theme building platform for creating beautiful and responsive websites.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-semibold text-gray-900 mb-4 tracking-wider uppercase">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-500 hover:text-gray-900">About Us</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-gray-900">Contact</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-gray-900">Support</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-gray-900">Blog</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-semibold text-gray-900 mb-4 tracking-wider uppercase">Resources</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-500 hover:text-gray-900">Documentation</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-gray-900">Tutorials</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-gray-900">API Reference</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-gray-900">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-semibold text-gray-900 mb-4 tracking-wider uppercase">Contact Us</h3>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <span class="text-gray-500">support@themebuilder.com</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-gray-500">+1 (555) 123-4567</span>
                    </li>
                </ul>
            </div>
        </div>

           {{-- <x-footer.classic-footer /> --}}
        <!-- Bottom Section -->
        <div class="border-t border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-center py-4">
                <p class="text-sm text-gray-500">© {{ date('Y') }} Theme Builder. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C8.745 0 8.333.014 7.053.072 5.775.131 4.902.438 4.13 1.034c-.771.596-1.463 1.549-1.961 2.663-.498 1.114-.783 2.369-.866 3.708-.082 1.339.067 2.535.387 3.58.32 1.045.898 1.917 1.733 2.555.834.639 1.893 1.011 3.11.99 1.218-.021 2.274-.354 3.111-.99.835-.638 1.413-1.51 1.733-2.555.32-.945.469-2.24.387-3.58-.084-1.339-.368-2.372-.866-3.708-.498-1.114-1.189-2.067-1.961-2.663C15.668.438 14.225.131 12.947.072 11.668.014 11.255 0 12 0zm0 5.838a6.162 6.162 0 010 12.323c1.691 0 3.075-.59 4.098-1.594.588-.087 1.147-.299 1.637-.619a4.362 4.362 0 001.594-1.434c.551-1.223.551-2.575.001-3.898a4.362 4.362 0 00-1.593-1.434 5.824 5.824 0 00-1.637-.619C15.075 7.428 13.691 6.838 12 6.838zm0 4.162a2.671 2.671 0 010 5.342c.846 0 1.529-.509 1.934-1.211.405-.702.405-1.523 0-2.225C13.529 10.509 12.846 10 12 10zm0-4.162a2.671 2.671 0 010 5.342c1.085 0 1.934-.846 1.934-1.934 0-.702-.405-1.523-.934-2.225C13.529 5.846 12.846 5.338 12 5.338z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
