<!-- Classic Contact Form -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Get in Touch</h2>

            <form class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="Enter your name" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="Enter your email" required>
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" id="subject" name="subject" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="Subject of your message" required>
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              placeholder="Enter your message" required></textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- <x-forms.classic-contact-form /> --}}
