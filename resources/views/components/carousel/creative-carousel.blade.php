<!-- Creative Carousel -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Portfolio</h2>
            <p class="text-xl text-gray-600">Showcasing our best work</p>
        </div>

        <div class="relative">
            <!-- Carousel Navigation -->
            <button class="absolute left-0 -translate-x-1/2 top-1/2 -translate-y-1/2 bg-white rounded-full p-4 shadow-lg hover:bg-gray-50 transition-colors" onclick="prevSlide()">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button class="absolute right-0 translate-x-1/2 top-1/2 -translate-y-1/2 bg-white rounded-full p-4 shadow-lg hover:bg-gray-50 transition-colors" onclick="nextSlide()">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Carousel Content -->
            <div class="relative overflow-hidden">
                <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
                    <!-- Slide 1 -->
                    <div class="w-full min-w-0 flex-none px-4">
                        <div class="relative h-[600px] mb-8">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                                 alt="Project 1" 
                                 class="w-full h-full object-cover rounded-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 flex flex-col justify-end p-8">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full">
                                            Web Design
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-600 bg-green-100 rounded-full">
                                            Development
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-sm text-white">4.8</span>
                                    </div>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-2">E-Commerce Platform</h3>
                                <p class="text-lg text-gray-300 mb-4">A modern e-commerce platform built with cutting-edge technologies.</p>
                                <div class="flex items-center gap-4">
                                    <a href="#" class="inline-flex items-center px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        View Project
                                    </a>
                                    <a href="#" class="inline-flex items-center px-6 py-3 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Case Study
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="w-full min-w-0 flex-none px-4">
                        <div class="relative h-[600px] mb-8">
                            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                                 alt="Project 2" 
                                 class="w-full h-full object-cover rounded-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 flex flex-col justify-end p-8">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-purple-600 bg-purple-100 rounded-full">
                                            Mobile App
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full">
                                            Design
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-sm text-white">4.9</span>
                                    </div>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-2">Mobile App</h3>
                                <p class="text-lg text-gray-300 mb-4">A revolutionary mobile application that transforms user experience.</p>
                                <div class="flex items-center gap-4">
                                    <a href="#" class="inline-flex items-center px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        View Project
                                    </a>
                                    <a href="#" class="inline-flex items-center px-6 py-3 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Case Study
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="w-full min-w-0 flex-none px-4">
                        <div class="relative h-[600px] mb-8">
                            <img src="https://images.unsplash.com/photo-1518640467707-6811f4a6ab73?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                                 alt="Project 3" 
                                 class="w-full h-full object-cover rounded-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 flex flex-col justify-end p-8">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-600 bg-green-100 rounded-full">
                                            Marketing
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-purple-600 bg-purple-100 rounded-full">
                                            Strategy
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-sm text-white">4.7</span>
                                    </div>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-2">Marketing Campaign</h3>
                                <p class="text-lg text-gray-300 mb-4">A comprehensive marketing campaign that delivered exceptional results.</p>
                                <div class="flex items-center gap-4">
                                    <a href="#" class="inline-flex items-center px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        View Project
                                    </a>
                                    <a href="#" class="inline-flex items-center px-6 py-3 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Case Study
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Indicators -->
            <div class="flex justify-center space-x-4 mt-8">
                <button class="w-12 h-12 rounded-full bg-white/80 backdrop-blur-sm p-3 hover:bg-white transition-colors" onclick="goToSlide(0)">
                    <div class="w-6 h-6 rounded-full bg-gray-300"></div>
                </button>
                <button class="w-12 h-12 rounded-full bg-white/80 backdrop-blur-sm p-3 hover:bg-white transition-colors" onclick="goToSlide(1)">
                    <div class="w-6 h-6 rounded-full bg-gray-300"></div>
                </button>
                <button class="w-12 h-12 rounded-full bg-white/80 backdrop-blur-sm p-3 hover:bg-white transition-colors" onclick="goToSlide(2)">
                    <div class="w-6 h-6 rounded-full bg-gray-300"></div>
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.getElementById('carousel');
        const dots = document.querySelectorAll('.rounded-full');

        function nextSlide() {
            currentSlide = (currentSlide + 1) % 3;
            updateSlide();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + 3) % 3;
            updateSlide();
        }

        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            updateSlide();
        }

        function updateSlide() {
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
            dots.forEach((dot, index) => {
                dot.querySelector('div').classList.toggle('bg-gray-300', index !== currentSlide);
                dot.querySelector('div').classList.toggle('bg-blue-500', index === currentSlide);
            });
        }

        // Auto advance slides every 5 seconds
        setInterval(nextSlide, 5000);
    </script>
</section>

{{-- <x-carousel.creative-carousel /> --}}
