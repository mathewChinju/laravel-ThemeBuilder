<!-- Modern Chatbot -->
<div class="fixed bottom-4 right-4 z-50">
    <div id="chatbot-container" class="hidden">
        <div class="bg-white rounded-2xl shadow-xl w-96 h-[600px] flex flex-col">
            <!-- Chat Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4 rounded-t-2xl flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold">Support Bot</h3>
                </div>
                <button onclick="toggleChatbot()" class="text-white hover:text-gray-200 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Chat Messages -->
            <div id="chat-messages" class="flex-1 overflow-y-auto p-4">
                <!-- Bot Message -->
                <div class="flex items-start mb-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-4 max-w-[80%]">
                        <p class="text-gray-600">Hi there! How can I assist you today?</p>
                    </div>
                </div>

                <!-- User Message -->
                <div class="flex items-start justify-end mb-4">
                    <div class="bg-blue-600 rounded-xl p-4 max-w-[80%]">
                        <p class="text-white">I need help with my order.</p>
                    </div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                <div class="flex gap-2">
                    <input type="text" 
                           id="chat-input" 
                           placeholder="Type your message..." 
                           class="flex-1 rounded-xl border border-gray-200 p-3 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500" 
                           onkeypress="handleKeyPress(event)" />
                    <button onclick="sendMessage()" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chatbot Button -->
    <button onclick="toggleChatbot()" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-full p-4 shadow-xl hover:shadow-2xl transition-all duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
        </svg>
    </button>
</div>

<script>
    function toggleChatbot() {
        const container = document.getElementById('chatbot-container');
        container.classList.toggle('hidden');
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    }

    function sendMessage() {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        
        if (message) {
            // Add user message
            const messagesDiv = document.getElementById('chat-messages');
            const userMessage = document.createElement('div');
            userMessage.className = 'flex items-start justify-end mb-4';
            userMessage.innerHTML = `
                <div class="bg-blue-600 rounded-xl p-4 max-w-[80%]">
                    <p class="text-white">${message}</p>
                </div>
            `;
            messagesDiv.appendChild(userMessage);
            
            // Clear input
            input.value = '';
            
            // Scroll to bottom
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
            
            // Simulate bot response
            setTimeout(() => {
                const botMessage = document.createElement('div');
                botMessage.className = 'flex items-start mb-4';
                botMessage.innerHTML = `
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-4 max-w-[80%]">
                        <p class="text-gray-600">I'll help you with that! Could you please provide more details?</p>
                    </div>
                `;
                messagesDiv.appendChild(botMessage);
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }, 1000);
        }
    }
</script>

{{-- <x-chatbot.modern-chatbot /> --}}
