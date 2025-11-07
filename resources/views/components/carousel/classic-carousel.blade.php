<!-- Classic Carousel -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Services</h2>
            <p class="text-gray-600">Discover what we offer</p>
        </div>

        <div class="relative">
            <!-- Carousel Navigation -->
            <button class="absolute left-0 -translate-x-1/2 top-1/2 -translate-y-1/2 bg-white rounded-full p-3 shadow-lg hover:bg-gray-50 transition-colors" onclick="prevSlide()">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button class="absolute right-0 translate-x-1/2 top-1/2 -translate-y-1/2 bg-white rounded-full p-3 shadow-lg hover:bg-gray-50 transition-colors" onclick="nextSlide()">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Carousel Content -->
            <div class="relative overflow-hidden">
                <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
                    <!-- Slide 1 -->
                    <div class="w-full min-w-0 flex-none px-4">
                        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                            <div class="relative h-64 mb-6">
                                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                                     alt="Service 1" 
                                     class="w-full h-full object-cover rounded-xl">
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Web Design</h3>
                            <p class="text-gray-600">Create stunning, responsive websites that convert visitors into customers.</p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="w-full min-w-0 flex-none px-4">
                        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                            <div class="relative h-64 mb-6">
                                <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                                     alt="Service 2" 
                                     class="w-full h-full object-cover rounded-xl">
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Digital Marketing</h3>
                            <p class="text-gray-600">Boost your online presence with our proven digital marketing strategies.</p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="w-full min-w-0 flex-none px-4">
                        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                            <div class="relative h-64 mb-6">
                                <img src="https://images.unsplash.com/photo-1518640467707-6811f4a6ab73?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                                     alt="Service 3" 
                                     class="w-full h-full object-cover rounded-xl">
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">App Development</h3>
                            <p class="text-gray-600">Build powerful mobile and web applications with modern technologies.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Indicators -->
            <div class="flex justify-center space-x-2 mt-8">
                <button class="w-2 h-2 rounded-full bg-gray-300" onclick="goToSlide(0)"></button>
                <button class="w-2 h-2 rounded-full bg-gray-300" onclick="goToSlide(1)"></button>
                <button class="w-2 h-2 rounded-full bg-gray-300" onclick="goToSlide(2)"></button>
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
                dot.classList.toggle('bg-gray-300', index !== currentSlide);
                dot.classList.toggle('bg-blue-500', index === currentSlide);
            });
        }

        // Auto advance slides every 5 seconds
        setInterval(nextSlide, 5000);
    </script>
</section>

{{-- <x-carousel.classic-carousel /> --}}
