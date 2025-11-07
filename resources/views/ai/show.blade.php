<!-- Projects Index Page -->
<x-app-layout> 
    <div class="min-h-screen">
        <div class="flex h-screen overflow-hidden">
            
            <!-- Left Sidebar -->
            <div class="w-1/4 bg-white border-r border-slate-100 flex flex-col">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Projects </h2>
                     {{-- <a href="{{ route('ai.index') }}" 
                    class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                     New Project
                 </a> --}}
                </div> 
 
                <!-- Prompt Form at Bottom -->
                <div class="p-6"> 
                    <form action="{{ route('ai.store') }}" method="POST" id="aiForm" enctype="multipart/form-data">
                     
                        @csrf
                           @if(session('preview_content'))
                           <div id="secondary-prompt" class="relative">
                            <label class="block text-sm font-medium text-gray-400 mb-1">Follow up Prompt</label>
                        
                            <div class="bg-white rounded-md border border-gray-300 shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 relative">
                                <textarea name="prompt" rows="10" required 
                                          class="w-full border-0 focus:ring-0 p-3 pr-12 resize-none" 
                                          placeholder="Ask a follow up... e.g., 'Add a navigation bar', 'Change the color scheme', 'Add a contact form', etc."></textarea>
                        
                                <div class="absolute bottom-2 right-2 flex space-x-2">
                                    {{-- <!-- Reference Attachment Button -->
                                    <button type="button" id="ref_attachment"
                                            class="inline-flex items-center px-3 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg> 
                                    </button> --}}
                                    
                                     <!-- Hidden file input -->
                                    <input type="file" id="reference_image" name="reference_image" accept="image/*" class="hidden" />
                                    <span id="file_name"></span>
                                     <!-- Attachment Button and Status -->
                                         <!-- Button -->
                                         <button type="button" id="ref_attachment"
                                         class="inline-flex items-center bg-slate-400 rounded-full p-2 text-white hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                            </svg> 
                                        </button> 

                                      <!-- Submit Button -->
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19V5M5 12l7-7 7 7"/>
                                            </svg> 
                                        </button>
                                </div>
 
                            </div>
                        
                            <div class="space-y-4 mt-4">
                                <div class="flex justify-between items-center"> 
                                    <!-- Revert -->
                                    <button type="button" onclick="revertChanges()" {{ !$hasHistory ? 'disabled' : '' }}
                                        class="inline-flex items-center px-4 py-2 bg-indigo-200 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:ring-offset-2 ml-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 .46-.05.91-.15 1.34" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.36 19a8 8 0 01-14.71-4.31" />
                                        </svg>
                                    </button> 
                        
                                    <!-- Clear -->
                                    <button type="button" onclick="clearPreview()"
                                        class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                         
                        @else
                        <div class="relative" id="primary-prompt">
                             <div class="bg-white rounded-md border border-gray-300 shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                                
                                <textarea name="prompt" rows="10" required 
                                class=" block w-full  border-0" placeholder="Ask for the layout design..."></textarea>
                  
                                  
                                     <!-- Hidden file input -->
                                        <input type="file" id="reference_image" name="reference_image" accept="image/*" class="hidden" />
                                        <span id="file_name"></span>

                                        <!-- Attachment Button and Status -->
                                             <!-- Button -->
                                            <button type="button" id="ref_attachment"
                                                class="inline-flex items-center bg-slate-400 rounded-full p-2 text-white hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                            </button>
 

                                    <button type="submit"
                                            class="inline-flex items-center right-2 bottom-2 bg-slate-400 rounded-full p-2 text-white hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 19V5M5 12l7-7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button> 
                            </div>
                        </div> 
                        @endif 
                    </form>   

                </div>
            </div>

            <!-- Right Content -->
            <div class="flex-1 overflow-y-auto p-6  " id="rightbar"> 

                {{-- @if(session('preview_content') || session('code_content'))
                 --}}
                    <!-- Layout Design Content -->
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                        <!-- Tab Navigation --> 
                       
                        <nav class="-mb-px flex" aria-label="Tabs">
                            <button id="preview-tab" class="tab-button px-4 py-3 text-sm font-medium border-b-2 "
                                 onclick="switchTab('preview')">
                                Preview
                            </button>
                            <button id="code-tab" class="tab-button px-4 py-3 ml-8 text-sm font-medium border-b-2 "
                             onclick="switchTab('code')">
                                HTML Code
                            </button> 

                            @if(session('preview_content') || session('code_content'))
                            <a href="{{ route('ai.download') }}" title="Download Preview as ZIP" class="inline-flex items-center px-3 py-2 text-slate-600 rounded-md hover:text-slate-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download ZIP
                            </a>
                            @endif
                        </nav>
                        
                        <!-- Tab Content -->
      
                    <div id="progress-container" 
                        style="position: relative;">
                   
                       <!-- Status message container -->
                       <div id="processStatus" 
                            class="flex items-center space-x-2 text-blue-600 text-sm font-medium rounded p-3 bg-blue-50 border border-blue-300 shadow-md"
                            style="display: none; position: absolute; top: 10px; left: 50%; transform: translateX(-50%); z-index: 9999; width: fit-content; max-width: 90%;">
                   
                           <!-- Spinner SVG -->
                           <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                               <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                               <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                           </svg>
                   
                           <span>Processing your request, please wait...</span>
                       </div>
                   
                       <!-- Optional overlay to focus on progress -->
                       <div id="progressOverlay" 
                            style="display: none; position: fixed; inset: 0; background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(2px); z-index: 9998;">
                       </div>
                   </div>
                   

                   <div class="p-6" id="response-container"> 
                              
                                @if(session('preview_content') || session('code_content'))
                
                                    <!-- Preview Tab Content -->
                                    <div id="preview-content" class="tab-content  active">  
                                        <div class="space-y-4">
                                            @if(session('preview_content')) 
                                                <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                                                    <iframe id="preview-frame" class="w-full h-[700px] border-0" srcdoc="{{ session('preview_content') }}" ></iframe>
                                                </div>

                                            @else
                                                <div class="text-gray-500 text-center py-12">
                                                    No preview content yet. Try submitting a prompt!
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Code Tab Content -->
                                    <div id="code-content" class="tab-content hidden">
                                        <div class="bg-gray-50 rounded-lg">
                                            <div class="p-2">
                                                @if(session('code_content'))
                                                    <div class="relative">
                                                        
                                                        <div class="bg-gray-100 rounded-lg overflow-auto h-[700px]">
                                                            <div class="p-4">
                                                                {!! session('code_content') !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-gray-500 text-center py-12">
                                                        No code content yet. Try submitting a prompt!
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-gray-500 text-center py-12"  >
                                        <script>
                                            clickPreview(); // <-- Only added to page when preview_content is empty
                                        </script>
                                        No layout design generated yet. Try submitting a prompt!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                {{-- @else
                    <div class="text-gray-500 text-center py-12">
                        No layout design generated yet. Try submitting a prompt!
                    </div>
                @endif --}}
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
             
            <script>
    document.addEventListener('DOMContentLoaded', function() {
        const refAttachmentBtn = document.getElementById('ref_attachment');
        const fileInput = document.getElementById('reference_image');
        const fileNameSpan = document.getElementById('file_name');
        const form = document.getElementById('aiForm');
        const promptTextarea = form.querySelector('textarea[name="prompt"]');
        const submitBtn = form.querySelector('button[type="submit"]');

        // Handle click on the attachment button
        if (refAttachmentBtn) {
            refAttachmentBtn.addEventListener('click', (e) => {
                e.preventDefault();
                fileInput.click();
            });
        }

        // Handle file selection
        if (fileInput) {
            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    // Display the file name
                    if (fileNameSpan) {
                        fileNameSpan.textContent = file.name;
                        fileNameSpan.classList.add('ml-2', 'text-sm', 'text-gray-600');
                    }

                    // Update UI based on file type
                    if (file.type.startsWith("image/")) {
                        // Change button to green with ring for image files
                        refAttachmentBtn.classList.remove("bg-slate-400", "hover:bg-slate-600", "focus:ring-blue-500", "text-white");
                        refAttachmentBtn.classList.add("bg-green-500", "hover:bg-green-600", "focus:ring-green-500", "ring-2", "ring-green-500", "text-white");
                    } else {
                        // Reset button for non-image files
                        refAttachmentBtn.classList.remove("bg-green-500", "hover:bg-green-600", "focus:ring-green-500", "ring-2", "ring-green-500");
                        refAttachmentBtn.classList.add("bg-slate-400", "hover:bg-slate-600", "focus:ring-blue-500", "text-white");
                    }

                    // If there's no text in the prompt, add a default one
                    if (promptTextarea && !promptTextarea.value.trim()) {
                        promptTextarea.value = `Create a layout based on the attached reference image. Pay attention to the following aspects:\n- Color scheme\n- Layout structure\n- Typography\n- Spacing and alignment\n- Overall aesthetic`;
                    }

                    // Submit the form
                    if (form) {
                        form.submit();
                    }
                }
            });
        }

        // Handle form submission
        if (form) {
            form.addEventListener('submit', function(e) {
                // Show loading state
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Generating...
                    `;
                }
            });
        }
        }
    }); 


           function switchTab(tab) {
                    const previewTab = document.getElementById('preview-tab');
                    const codeTab = document.getElementById('code-tab');
                
                    // Remove active styles
                    [previewTab, codeTab].forEach(tabBtn => {
                        tabBtn.classList.remove('text-indigo-800', 'border-indigo-400', 'font-semibold');
                        tabBtn.classList.add('text-gray-500', 'border-transparent');
                    });
                
                    // Add active styles to selected tab
                    const activeTab = tab === 'preview' ? previewTab : codeTab;
                    activeTab.classList.add('text-indigo-800', 'border-indigo-400', 'font-semibold');
                    activeTab.classList.remove('text-gray-500', 'border-transparent');
                
                    // Switch tab content visibility
                    const previewContent = document.getElementById('preview-content');
                    const codeContent = document.getElementById('code-content');
                
                    if (tab === 'preview') {
                        previewContent.classList.remove('hidden');
                        codeContent.classList.add('hidden');
                    } else {
                        codeContent.classList.remove('hidden');
                        previewContent.classList.add('hidden');
                    }
                }
                </script>
                
                 <script>
             

                function isEmptyOrWhitespace(str) {
                    return !str || !str.trim();
                }

                function isMeaninglessPrompt(prompt) {
                    const trimmed = prompt.trim();
                    
                    // Check minimum length
                    if (trimmed.length < 3) return true;
                    
                    // Check if it contains at least 3 letters (to catch cases like 'a b c')
                    const letterCount = (trimmed.match(/[a-zA-Z]/g) || []).length;
                    if (letterCount < 3) return true;
                    
                    // Check if it contains at least one meaningful word (3+ letters)
                    const words = trimmed.split(/\s+/).filter(word => word.length >= 3);
                    if (words.length === 0) return true;
                    
                    // Check if the input is mostly special characters or numbers
                    const specialChars = (trimmed.match(/[^\w\s]/g) || []).length;
                    const numbers = (trimmed.match(/\d/g) || []).length;
                    const totalChars = trimmed.length;
                    
                    // If more than 50% of characters are special chars or numbers, consider it meaningless
                    if ((specialChars + numbers) / totalChars > 0.5) return true;
                    
                    return false;
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('aiForm');
                    const statusDiv = document.getElementById('processStatus');
                    const overlay = document.getElementById('progressOverlay');

                    if (form && statusDiv && overlay) {
                        form.addEventListener('submit', function(e) {
                            const promptInput = form.querySelector('textarea[name="prompt"]');
                            const prompt = promptInput ? promptInput.value : '';
                            
                            // Validate prompt
                            if (isEmptyOrWhitespace(prompt)) {
                                e.preventDefault();
                                alert('Please enter a prompt before submitting.');
                                return;
                            }
                            
                            if (isMeaninglessPrompt(prompt)) {
                                e.preventDefault();
                                alert('Please provide a more descriptive prompt with meaningful content.');
                                return;
                            }
                            
                            // Show the status message and overlay
                            statusDiv.style.display = 'flex';  // flex for horizontal layout
                            overlay.style.display = 'block';

                            // Disable all submit buttons to prevent multiple submits
                            const submitButtons = form.querySelectorAll('button[type="submit"]');
                            submitButtons.forEach(btn => btn.disabled = true);
                        });
                    }
                    
                });
  

                 document.addEventListener('DOMContentLoaded', function() {
                    const iframe = document.getElementById('preview-frame');
                    if (iframe) {
                        function attachClickListener() {
                            try {
                                const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                                if (iframeDoc && !iframeDoc._clickListenerAdded) {
                                    iframeDoc.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        console.log('Iframe click:', e);
                                        e.stopPropagation();
                                        return false;
                                    }, true);
                                    iframeDoc._clickListenerAdded = true; // flag to avoid duplicates
                                }
                            } catch (err) {
                                console.warn("Unable to access iframe content:", err);
                            }
                        }

                        // Try attaching immediately
                        attachClickListener();

                        // Also attach onload as fallback
                        iframe.onload = attachClickListener;

                        // Optional: poll until listener attached
                        const intervalId = setInterval(() => {
                            attachClickListener();
                            if (iframe.contentDocument && iframe.contentDocument._clickListenerAdded) {
                                clearInterval(intervalId);
                            }
                        }, 100);
                    }
                });


            </script>
      
       
            <script>
                // Function to revert to previous layout
                

                function revertChanges() {
                    fetch('/ai/projects/revert-layout', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Refresh the page to show the previous layout and code
                        } else {
                            alert('Failed to revert changes ');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while reverting changes');
                    });
                }

                function unescapeHtml(escapedHtml) {
                    if (typeof escapedHtml !== 'string') {
                        console.warn('unescapeHtml: input is not a string, returning empty.', escapedHtml);
                        return "";
                    }
                    const tempElement = document.createElement('textarea');
                    tempElement.innerHTML = escapedHtml;
                    return tempElement.value;
                }
 

                // Clear preview functionality 
                function clearPreview() {
                        // Clear session data
                        fetch('/ai/projects/clear-preview', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Failed to clear preview');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Clear the preview and code content
                                const previewContent = document.getElementById('preview-content');
                                const codeContent = document.getElementById('code-content');
                                
                                if (previewContent) {
                                    previewContent.innerHTML = '<div class="text-gray-500 text-center py-12">No preview content yet. Try submitting a prompt!</div>';
                                }
                                if (codeContent) {
                                    codeContent.innerHTML = '<div class="text-gray-500 text-center py-12">No code content yet. Try submitting a prompt!</div>';
                                }
                                
                                // Show primary prompt and hide secondary prompt
                                const primaryPrompt = document.getElementById('primary-prompt');
                                const secondaryPrompt = document.getElementById('secondary-prompt');
                                
                                if (primaryPrompt) {  
                                    primaryPrompt.style.display = 'block';
                                    window.location.reload();   
                                }
                                if (secondaryPrompt) {   
                                    secondaryPrompt.style.display = 'none';
                                    window.location.reload();   
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error clearing preview:', error);
                            alert('Failed to clear preview. Please try again.');
                        });
                }
      
            </script>

    
</div>
    </div>
</x-app-layout>