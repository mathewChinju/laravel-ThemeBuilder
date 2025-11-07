<!-- Projects Index Page -->
<x-app-layout> 
    <div class="min-h-screen">
        <div class="flex h-screen overflow-hidden">
            <!-- Left Sidebar -->
            <div class="w-1/4 bg-white border-r border-slate-100 flex flex-col">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Project History</h2>

                    <a href="{{ route('projects_new.index') }}" 
                    class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                     New Project
                 </a>
                </div>

                <!-- Scrollable History Section -->
                <div class="flex-1 overflow-y-auto p-6">
                    @if(isset($project))
                        <div class="space-y-4" id="history-list">
                            @foreach($project->promptHistories->sortBy('created_at') as $history)
                                <div id="history-{{ $history->id }}"
                                    class="history-entry bg-white rounded-lg p-4 hover:bg-gray-50 cursor-pointer transition"
                                    onclick="showHistory('{{ $history->id }}')">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-md font-semibold text-gray-800">{{ $history->prompt }}</h3>
                                            <p class="text-xs text-gray-600">{{ $history->created_at->format('M d, Y H:i') }}</p>
                                        </div>
                                        <button onclick="event.stopPropagation(); deleteHistory('{{ $history->id }}')"
                                                class="text-red-500 hover:text-red-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>


                <!-- Prompt Form at Bottom -->
                <div class="p-6"> 
                    <form action="{{ route('projects_new.update', $project) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-400 mb-1">Follow up Prompt</label>
                            <div class="bg-white rounded-md border border-gray-300 shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                                {{-- <textarea name="prompt" rows="4" required 
                                          class="w-full border-0 focus:ring-0 pr-10 resize-none p-3 " >
                                </textarea> --}}
                                <textarea name="prompt" rows="4" required 
                                class=" block w-full  border-0" placeholder="Ask a follow up..."></textarea>
                  
                                <button type="submit"
                                        class="absolute right-2 bottom-2 bg-slate-400 rounded-full p-2 text-white hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 19V5M5 12l7-7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>                   
                </div>
            </div>

            <!-- Right Content -->
            <div class="flex-1 overflow-y-auto p-6" id="rightbar">
                @if(isset($project))
                    <!-- Project Details -->
                    

                    <!-- Tabs -->
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                        <!-- Tab Navigation -->
                        <div class="border-b border-slate-200">
                            <nav class="-mb-px flex" aria-label="Tabs">
                                <button id="preview-tab" class="preview-tab-button px-4 py-3 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300" 
                                        onclick="switchTab('preview')">
                                    Preview
                                </button>
                                <button id="code-tab" class="code-tab-button px-4 py-3 ml-8 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300" 
                                        onclick="switchTab('code')">
                                    HTML Code
                                </button>
                                <button id="download-preview-zip" title="Download Preview as ZIP" class="inline-flex items-center px-3 py-2  text-slate-600 rounded-md ">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download ZIP
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                            <div class="p-6">
                                <!-- Preview Tab Content -->
                                <div id="preview-content" class="tab-content active">  
                                    <div class="space-y-4">
                                        @if($latestPreviewData)
                                    
                                            @php
                                                $sections = [];
                                                foreach($latestPreviewData['components'] as $component) {
                                                    if (!isset($sections[$component['position']])) {
                                                        $sections[$component['position']] = [];
                                                    }
                                                    $sections[$component['position']][] = $component;
                                                }
                                            @endphp
                                    
                                            @foreach($sections as $position => $components)
                                                <div class="mb-6">
                                                    <div class="grid gap-6">
                                                        @foreach($components as $component)
                                                            @if($component['blade_file'])
                                                                {{-- Keep your blade resolving logic as is --}}
                                                                @php
                                                                    $componentType = $component['type'];
                                                                    $componentsPath = resource_path('views/components');
                                                                    $bladeFile = null;
                                                                    $subfolders = File::directories($componentsPath);
                                    
                                                                    foreach ($subfolders as $subfolder) {
                                                                        if (strpos(basename($subfolder), $componentType) !== false) {
                                                                            foreach (File::files($subfolder) as $file) {
                                                                                if (strpos($file->getRelativePathname(), '.blade.php') !== false) {
                                                                                    $bladeFile = $file->getRelativePathname();
                                                                                    break 2;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                    
                                                                    $subfolderName = '';
                                                                    foreach ($subfolders as $subfolder) {
                                                                        if (strpos(basename($subfolder), $componentType) !== false) {
                                                                            $subfolderName = basename($subfolder);
                                                                            break;
                                                                        }
                                                                    }
                                    
                                                                    $fullPath = str_replace(resource_path('views/components/'), '', $bladeFile);
                                                                    $pathWithoutExtension = str_replace('.blade.php', '', $fullPath);
                                                                    $viewPath = str_replace('/', '.', $pathWithoutExtension);
                                    
                                                                    if ($subfolderName) {
                                                                        $viewPath = "components.{$subfolderName}." . basename($viewPath);
                                                                    } else {
                                                                        $viewPath = "components." . $viewPath;
                                                                    }
                                                                @endphp
                                    
                                                                @include($viewPath, [
                                                                    'position' => $component['position'],
                                                                    'priority' => $component['priority']
                                                                ])
                                                            @else
                                                                <div class="p-4 bg-gray-50 rounded-lg">
                                                                    <h4 class="font-medium">{{ $component['type'] }}</h4>
                                                                    <p class="text-gray-600">{{ $component['content'] }}</p>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-500">No preview available</p>
                                        @endif
                                    </div>
                                    
                                </div>

                                <!-- Code Tab Content -->
                                <div id="code-content" class="tab-content hidden">
                                    <div class="flex justify-between items-center mb-4">
                                        {{-- <h3 class="text-xl font-semibold">HTML Code</h3> --}}
                                        <button id="refresh-code" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Refresh
                                        </button>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg">
                                        <div class="p-2"> 
                                            
                                            @php
                                                $bladePaths = [];

                                                if ($project->html_content) {
                                                    // Step 1: Extract all Blade file paths
                                                    preg_match_all('/Blade file path:\s*(.*?\.blade\.php)/', $project->html_content, $matches);
                                                    $bladePaths = $matches[1] ?? [];
                                                }

                                                $rawFileContents = [];

                                                foreach ($bladePaths as $absolutePath) {
                                                    // Normalize the full path (Laravel typically starts from resources/views/)
                                                    $fullPath = base_path('resources/views/' . str_replace(['views/', '.blade.php'], ['', ''], $absolutePath) . '.blade.php');

                                                    if (file_exists($fullPath)) {
                                                        $rawFileContents[] = [
                                                            'filename' => basename($fullPath),
                                                            'path' => $fullPath,
                                                            'code' => file_get_contents($fullPath),
                                                        ];
                                                    }
                                                }
                                            @endphp

                                            @if (!empty($rawFileContents))
                                                <div class="component-source-codes">
                                                    {{-- <h4>Component Source Code Preview</h4> --}}

                                                    @foreach ($rawFileContents as $file)
                                                        {{-- <div class="component-code" style="margin-bottom: 2rem;">
                                                             <pre style="background: #f8f8f8; padding: 1rem; overflow-x: auto;">
                                                            <code>{{ $file['code']  }}</code>
                                                            </pre>
                                                        </div> --}}
                                                        <div class="component-code mb-6">
                                                                <label class="text-sm text-gray-600 font-semibold block mb-1">{{ $file['filename'] }}</label>
                                                                
                                                                {{-- Editable textarea --}}
                                                                <textarea class="editable-html w-full p-4 bg-gray-100 rounded border resize-y text-sm" 
                                                    data-id="{{ $loop->index }}" 
                                                    rows="10">{!! $file['code'] !!}</textarea>

                                                            </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <textarea id="html-code" rows="10" class="w-full h-full p-4 bg-gray-50 rounded-lg border-none focus:ring-0 resize-none" 
                                                                                            placeholder="HTML code will appear here...">  </textarea>
                                            @endif
    
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @else 
                    <!-- New Project Form -->
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                        <form action="{{ route('projects_new.store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Prompt</label>
                                    <textarea name="prompt" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-500"></textarea>
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
                @endif
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
            <script>
                function unescapeHtml(escapedHtml) {
                    if (typeof escapedHtml !== 'string') {
                        console.warn('unescapeHtml: input is not a string, returning empty.', escapedHtml);
                        return "";
                    }
                    const tempElement = document.createElement('textarea');
                    tempElement.innerHTML = escapedHtml;
                    return tempElement.value;
                }

               


                function showHistory(historyId) {  

                     document.querySelectorAll('.history-entry').forEach(entry => {
                        entry.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-200');
                    });

                    // Add highlight to the clicked one
                    const selectedEntry = document.getElementById('history-' + historyId);
                    if (selectedEntry) {
                        selectedEntry.classList.add('ring-2', 'ring-indigo-500', 'bg-indigo-200');
                    }


                    fetch(`/new-projects/history/${historyId}`)
                        .then(response => response.json())
                        .then(data => {
                           // console.log(data.html_code);
                            // document.getElementById('preview-content').innerHTML = data.html;
                            document.getElementById('preview-content').innerHTML = data.preview_html;
                            document.getElementById('code-content').innerHTML = data.html_code;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to load preview section');
                        });
                }



                function deleteHistory(historyId) {  
                    if (confirm('Are you sure you want to delete this history entry?')) {
                        fetch(`/new-projects/prompt-history/${historyId}`, {
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
                                if(data.counts==0){
                                    alert('Project deleted successfully');
                                    window.location.href='/new-projects';
                                }else{
                                  alert('History entry deleted successfully');

                                }
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

                function switchTab(tabName) {
                    const previewTab = document.getElementById('preview-tab');
                    const codeTab = document.getElementById('code-tab');
                    const previewContent = document.getElementById('preview-content');
                    const codeContent = document.getElementById('code-content');

                    if (tabName === 'preview') {
                        previewTab.classList.add('border-blue-500', 'text-blue-600');
                        codeTab.classList.remove('border-blue-500', 'text-blue-600');
                        previewContent.classList.remove('hidden');
                        codeContent.classList.add('hidden');
                    } else if (tabName === 'code') {
                        codeTab.classList.add('border-blue-500', 'text-blue-600');
                        previewTab.classList.remove('border-blue-500', 'text-blue-600');
                        codeContent.classList.remove('hidden');
                        previewContent.classList.add('hidden');
                    }
                }

                // Download preview HTML as ZIP
                document.getElementById('download-preview-zip').addEventListener('click', function() {
                    const htmlElement = document.getElementById('preview-content'); // Get the PREVIEW element by ID for clarity
                    if (!htmlElement || !htmlElement.innerHTML.trim()) { // Check innerHTML and trim() to ensure it's not just whitespace
                        alert('No HTML content to download.');
                        return;
                    }
                    const previewHtmlFromDiv = htmlElement.innerHTML; // This should be the raw, renderable preview HTML
                    const renderableHtmlBody = unescapeHtml(previewHtmlFromDiv); // Unescape (as a safeguard) to get raw HTML for the file

                    if (typeof JSZip === 'undefined') {
                        alert('JSZip library not loaded. Please ensure you are connected to the internet or contact support if the issue persists.');
                        console.error('JSZip is not defined. Make sure the library is loaded correctly.');
                        return;
                    }

                    try {
                        const zip = new JSZip();
                        const fullHtmlContent =
                            '<!DOCTYPE html>\n' +
                            '<html lang="en">\n' +
                            '<head>\n' +
                            '    <meta charset="UTF-8">\n' +
                            '    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n' +
                            '    <title>Preview</title>\n' +
                            '    <!-- Fonts -->\n' +
                            '    <link rel="preconnect" href="https://fonts.bunny.net">\n' +
                            '    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />\n' +
                            '    <!-- Tailwind CSS -->\n' +
                            '    <script src="https://cdn.tailwindcss.com"><' + '/script>\n' +
                            '    <!-- Alpine.js -->\n' +
                            '    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"><' + '/script>\n' +
                            '    <style>\n' +
                            "        /* You can add basic body styles here if needed, or if Tailwind needs a moment to initialize */\n" +
                            "        body { font-family: 'Figtree', sans-serif; }\n" +
                            '    </style>\n' +
                            '</head>\n' +
                            '<body>\n' +
                            renderableHtmlBody + // Use the unescaped, renderable HTML
                            '\n</body>\n' +
                            '</html>';
                        console.log("Attempting to zip fullHtmlContent. Length:", fullHtmlContent.length); // Log length
                        // For detailed inspection, you might log a snippet or the whole thing if not too large:
                        // console.log("Content to zip:", fullHtmlContent.substring(0, 500) + (fullHtmlContent.length > 500 ? '...' : '')); 

                        try {
                            zip.file("test.txt", "This is a simple test file."); // Test with simple content
                            console.log("'test.txt' added to zip successfully.");
                        } catch (e) {
                            console.error("Error adding 'test.txt' to zip:", e);
                        }

                        console.log("Adding 'index.html' to zip...");
                        zip.file("index.html", fullHtmlContent);
                        // You can add more files here if needed, e.g., CSS, JS
                        // zip.file("css/style.css", "body { font-family: sans-serif; }");
                        // zip.file("js/script.js", "console.log('Hello from zipped script!');");

                        zip.generateAsync({ type: "blob" })
                            .then(function(content) {
                                const link = document.createElement('a');
                                link.href = URL.createObjectURL(content);
                                link.download = "{{ $project->name ?? 'preview' }}.zip"; // Use project name for the zip file
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                                URL.revokeObjectURL(link.href);
                            })
                            .catch(function(error) {
                                console.error('Error generating ZIP:', error);
                                alert('Failed to generate ZIP file: ' + error.message);
                            });
                    } catch (error) {
                        console.error('Error during ZIP creation process:', error);
                        alert('An unexpected error occurred while preparing the download: ' + error.message);
                    }
                });
            </script>
        </div>
    </div>
                     
    </script>
</x-app-layout>
 