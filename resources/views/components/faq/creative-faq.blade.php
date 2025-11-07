<!-- Creative FAQ Section -->
<section class="py-20 bg-gradient-to-r from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Got Questions?</h2>
            <p class="text-xl text-gray-600">We've got the answers you need</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="space-y-6">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <button class="flex justify-between items-center w-full text-left focus:outline-none" onclick="toggleFAQ('faq1')">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-gray-900 font-medium">How do I get started?</span>
                                <span class="block text-sm text-gray-500">Quick setup guide</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span id="faq1-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </button>
                    <div id="faq1-content" class="hidden mt-4 text-gray-600">
                        Getting started is easy! Just sign up for an account and start building your website right away. 
                        Our intuitive interface makes it simple to create beautiful websites without any coding knowledge.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <button class="flex justify-between items-center w-full text-left focus:outline-none" onclick="toggleFAQ('faq2')">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-gray-900 font-medium">What features are included?</span>
                                <span class="block text-sm text-gray-500">Complete feature list</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span id="faq2-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </button>
                    <div id="faq2-content" class="hidden mt-4 text-gray-600">
                        Our platform includes a wide range of features including drag-and-drop builder, custom domains, 
                        SSL certificates, and 24/7 support. Plus, you get access to our extensive library of templates.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <button class="flex justify-between items-center w-full text-left focus:outline-none" onclick="toggleFAQ('faq3')">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-gray-900 font-medium">Is there a free trial?</span>
                                <span class="block text-sm text-gray-500">Trial details</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span id="faq3-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </button>
                    <div id="faq3-content" class="hidden mt-4 text-gray-600">
                        Yes, we offer a 14-day free trial with full access to all features. No credit card required to start.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <button class="flex justify-between items-center w-full text-left focus:outline-none" onclick="toggleFAQ('faq4')">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-gray-900 font-medium">How do I get support?</span>
                                <span class="block text-sm text-gray-500">Support options</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span id="faq4-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </button>
                    <div id="faq4-content" class="hidden mt-4 text-gray-600">
                        Our support team is available 24/7 via chat, email, and phone. We also have extensive documentation 
                        and video tutorials available in our knowledge base.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFAQ(id) {
            const content = document.getElementById(`${id}-content`);
            const icon = document.getElementById(`${id}-icon`);
            
            if (content.style.display === "block") {
                content.style.display = "none";
                icon.style.transform = "rotate(0deg)";
            } else {
                // Close all other FAQ items
                const allContents = document.querySelectorAll('.hidden');
                allContents.forEach(content => content.style.display = "none");
                const allIcons = document.querySelectorAll('svg');
                allIcons.forEach(icon => icon.style.transform = "rotate(0deg)");
                
                // Open the clicked FAQ
                content.style.display = "block";
                icon.style.transform = "rotate(180deg)";
            }
        }
    </script>
</section>

{{-- <x-faq.creative-faq /> --}}
