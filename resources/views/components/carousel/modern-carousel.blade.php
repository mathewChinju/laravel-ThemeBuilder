<!-- Modern Carousel -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Solutions</h2>
            <p class="text-xl text-gray-600">Innovative solutions for modern businesses</p>
        </div>

        <div class="relative">
            <!-- Carousel Navigation -->
            <button class="absolute left-0 -translate-x-1/2 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm rounded-full p-4 shadow-lg hover:bg-white transition-colors" onclick="prevSlide()">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button class="absolute right-0 translate-x-1/2 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm rounded-full p-4 shadow-lg hover:bg-white transition-colors" onclick="nextSlide()">
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
                                 alt="Solution 1" 
                                 class="w-full h-full object-cover rounded-3xl">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-8">
                                <h3 class="text-4xl font-bold text-white mb-4">Cloud Solutions</h3>
                                <p class="text-xl text-gray-300">Scalable and secure cloud infrastructure for your business needs.</p>
                                <a href="#" class="inline-flex items-center px-6 py-3 mt-6 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="w-full min-w-0 flex-none px-4">
                        <div class="relative h-[600px] mb-8">
                            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                                 alt="Solution 2" 
                                 class="w-full h-full object-cover rounded-3xl">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-8">
                                <h3 class="text-4xl font-bold text-white mb-4">AI Integration</h3>
                                <p class="text-xl text-gray-300">Intelligent automation and AI-powered solutions for your business.</p>
                                <a href="#" class="inline-flex items-center px-6 py-3 mt-6 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="w-full min-w-0 flex-none px-4">
                        <div class="relative h-[600px] mb-8">
                            <img src="https://images.unsplash.com/photo-1518640467707-6811f4a6ab73?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                                 alt="Solution 3" 
                                 class="w-full h-full object-cover rounded-3xl">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-8">
                                <h3 class="text-4xl font-bold text-white mb-4">Enterprise Solutions</h3>
                                <p class="text-xl text-gray-300">Custom enterprise solutions tailored for your business.</p>
                                <a href="#" class="inline-flex items-center px-6 py-3 mt-6 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Indicators -->
            <div class="flex justify-center space-x-4 mt-8">
                <button class="w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm p-2 hover:bg-white transition-colors" onclick="goToSlide(0)">
                    <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                </button>
                <button class="w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm p-2 hover:bg-white transition-colors" onclick="goToSlide(1)">
                    <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                </button>
                <button class="w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm p-2 hover:bg-white transition-colors" onclick="goToSlide(2)">
                    <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.getElementById('carousel');
        const dots = document.querySelectorAll('.rounded-full');
        let autoScrollInterval;

        function startAutoScroll() {
            autoScrollInterval = setInterval(nextSlide, 4000); // 4 seconds interval
        }

        function pauseAutoScroll() {
            clearInterval(autoScrollInterval);
        }

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
                dot.querySelector('span').classList.toggle('bg-gray-300', index !== currentSlide);
                dot.querySelector('span').classList.toggle('bg-blue-500', index === currentSlide);
            });
        }

        // Start auto-scroll when page loads
        startAutoScroll();

        // Pause auto-scroll on hover
        slides.addEventListener('mouseenter', pauseAutoScroll);
        slides.addEventListener('mouseleave', startAutoScroll);

        // Pause auto-scroll when interacting with navigation
        dots.forEach(dot => {
            dot.addEventListener('click', pauseAutoScroll);
        });
    </script>
</section>

{{-- <x-carousel.modern-carousel /> --}}
