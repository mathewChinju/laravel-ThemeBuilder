<!-- Projects Index Page -->
<x-app-layout> 
    <div class="min-h-screen">
        <div class="flex h-screen overflow-hidden">
            <!-- Left Sidebar -->
            <div class="w-1/4 bg-white border-r border-slate-100 flex flex-col">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Projects</h2>
                    {{-- <a href="{{ route('projects_new.create') }}" 
                       class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        New Project
                    </a> --}}
                </div>
                <div class="flex-1 overflow-y-auto p-6">
                    <!-- Projects List -->
                    @if($projects->count() > 0)
                        <div class="space-y-4">
                            @foreach($projects as $project)
                                <a href="{{ route('projects_new.show', $project) }}" 
                                   class="block bg-white rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800">{{ $project->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ $project->prompt }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $project->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-lg p-4 text-center">
                            <p class="text-gray-500">No projects found</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Content -->
              <!-- Right Content -->
            <div class="flex-1 overflow-y-auto p-6" id="rightbar">
                    
                
                    <!-- New Project Form -->
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                         
                        <form action="{{ route('projects_new.store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <!-- Suggestions Section -->
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-sm font-medium text-gray-600">Webpage Creation Suggestions:</h3>
                                        <div class="relative w-48">
                                            <input type="text" id="suggestionSearch" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
                                                   placeholder="Search suggestions...">
                                        </div>
                                    </div>
                                    <div class="max-h-64 overflow-y-auto space-y-2" id="suggestionsContainer">
                                        <button type="button" class="suggestion-btn w-full text-left px-2 py-1.5 rounded hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" data-template="ecommerce">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                                </svg>
                                                <span>Create a modern, responsive e-commerce website</span>
                                            </div>
                                        </button>
                                        <button type="button" class="suggestion-btn w-full text-left px-2 py-1.5 rounded hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" data-template="portfolio">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <span>Design a professional business portfolio</span>
                                            </div>
                                        </button>
                                        <button type="button" class="suggestion-btn w-full text-left px-2 py-1.5 rounded hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" data-template="blog">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                                </svg>
                                                <span>Build a personal blog with custom styling</span>
                                            </div>
                                        </button>
                                        <button type="button" class="suggestion-btn w-full text-left px-2 py-1.5 rounded hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" data-template="landing">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                                <span>Develop a landing page for your product</span>
                                            </div>
                                        </button>
                                        <button type="button" class="suggestion-btn w-full text-left px-2 py-1.5 rounded hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" data-template="dashboard">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                                                </svg>
                                                <span>Create an interactive dashboard interface</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="block text-md font-bold text-gray-700">What can I build for you ?</h3>
                                    <textarea name="prompt" rows="4" required placeholder="Ask to build..."
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-500"></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="inline-flex items-center px-1 py-1 bg-slate-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 19V5M5 12l7-7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                              </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                
            </div>
             
        </div>
    </div>

    <script>
        // Handle suggestion clicks and template generation
        document.addEventListener('DOMContentLoaded', function() {
            const suggestions = document.querySelectorAll('.suggestion-btn');
            const promptTextarea = document.querySelector('textarea[name="prompt"]');
            const searchInput = document.getElementById('suggestionSearch');
            const suggestionsContainer = document.getElementById('suggestionsContainer');

            // Search functionality
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                suggestions.forEach(suggestion => {
                    const text = suggestion.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        suggestion.style.display = 'block';
                    } else {
                        suggestion.style.display = 'none';
                    }
                });
            });

            const templates = {
                'ecommerce': `Create an e-commerce website with:
                1. Header with navigation and cart
                2. Hero section with product categories
                3. Product grid layout
                4. Footer with newsletter signup
                5. Mobile-responsive design`,
                                'portfolio': `Design a professional portfolio with:
                1. Header with navigation and profile
                2. Hero section with introduction
                3. Portfolio grid with project cards
                4. Contact section with form
                5. Mobile-responsive layout`,
                                'blog': `Build a personal blog with:
                1. Header with navigation and search
                2. Hero section with featured post
                3. Blog post grid layout
                4. Slidebar with categories
                5. Mobile-responsive design`,
                                'landing': `Create a landing page with:
                1. Header with navigation
                2. Hero section with call-to-action
                3. Features grid
                4. Pricing section
                5. Footer with contact info`,
                                'dashboard': `Design a dashboard interface with:
                1. Header with navigation
                2. Sidebar with menu
                3. Main content area with widgets
                4. Responsive grid layout
                5. Mobile-friendly design`
            };

            // Add hover effect to show full text
            suggestions.forEach(suggestion => {
                suggestion.addEventListener('mouseenter', function() {
                    this.style.width = '100%';
                });
                
                suggestion.addEventListener('mouseleave', function() {
                    this.style.width = 'auto';
                });
            });

            suggestions.forEach(suggestion => {
                suggestion.addEventListener('click', function() {
                    const templateType = this.getAttribute('data-template');
                    if (templates[templateType]) {
                        promptTextarea.value = templates[templateType];
                    } else {
                        promptTextarea.value = this.textContent;
                    }
                    promptTextarea.focus();
                });
            });
        });

        function showHistory(historyId) {
            fetch(`/projects/history/${historyId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('preview-content').innerHTML = `
                        <div class="space-y-4">
                            ${data.components.map(component => `
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <h4 class="font-medium">${component.type}</h4>
                                    <p class="text-gray-600">${component.content}</p>
                                </div>
                            `).join('')}
                        </div>
                    `;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to load history details');
                });
        }

        function deleteHistory(historyId) {
            if (confirm('Are you sure you want to delete this history entry?')) {
                fetch(`/projects/prompt-history/${historyId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const element = document.querySelector(`[onclick*="${historyId}"]`);
                        if (element) {
                            element.closest('.bg-white').remove();
                        }
                        alert('History entry deleted successfully');
                    } else {
                        alert('Failed to delete history entry');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the history entry');
                });
            }
        }
    </script>
</x-app-layout>
 