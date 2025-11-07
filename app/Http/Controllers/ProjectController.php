<?php

namespace App\Http\Controllers;

use App\Models\Project;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PromptHistory;
use App\Services\PromptProcessor;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ProjectController;

class ProjectController extends Controller
{
    public function index()
    {  
        $projects = Project::latest()->paginate(10);
        $hasHistory = !empty(session('layout_history', [])); 

        return view('ai.show',[
            'projects'=>$projects,
            'hasHistory'=>$hasHistory,
        ]); 
        
       // compact('projects' ));
    } 

   /* public function revertLayout(Request $request)
    {
        // Get the previous layout from session
        $previousLayout = session('previous_layout');
        $previousCode = session('previous_code');
        
        if ($previousLayout &&   $previousCode) {
            // Restore the previous layout
            session(['preview_content' => $previousLayout]);
            session(['code_content' => $previousCode]);

            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'No previous layout found']);
    }
    */

  
    public function revertLayout(Request $request)
    {
        $history = session('layout_history', []);
    
        if (!empty($history)) {


            // Pop the last saved state
            $lastState = array_pop($history);
    
            // Restore the previous layout and code
            session(['preview_content' => $lastState['preview']]);
            session(['code_content' => $lastState['code']]);
    
           
            // Save the updated history stack back to the session
            session(['layout_history' => $history]);
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'No previous layout found']);
    }
    
    
    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'prompt' => 'required|string',
            'reference_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $prompt = $validated['prompt'];
        $referenceImage = null;

        // Handle file upload if present
        if ($request->hasFile('reference_image')) {
            $image = $request->file('reference_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('reference_images', $filename, 'public');
            $referenceImage = asset('storage/' . $path);
            
            // Store the reference image path in the session
            session(['reference_image' => $referenceImage]);
            
            // Enhance the prompt with reference image context
            $prompt = "Reference Image URL: {$referenceImage}\n\n" . $prompt;
            $prompt .= "\n\nIMPORTANT: Please analyze the reference image and use it as the primary guide for the layout, color scheme, typography, and overall design. ";
            $prompt .= "Match the visual style, spacing, and structure shown in the image. ";
            $prompt .= "Pay attention to the placement of elements, color combinations, and overall aesthetic.";
        }
        
        if ($request->hasFile('reference_image')) {
            $path = $request->file('reference_image')->store('reference_images', 'public');
            $referenceImage = Storage::url($path);
            
            // Store the reference image path in the session for future reference
            session(['reference_image' => $referenceImage]);
            
            // Add reference to prompt with more specific instructions
            $prompt = "Reference Image: {$referenceImage}\n\n" . $prompt;
            $prompt .= "\n\nIMPORTANT: Please analyze the reference image and use it as the primary guide for the layout, color scheme, typography, and overall design. ";
            $prompt .= "Match the visual style, spacing, and structure shown in the image. ";
            $prompt .= "Pay attention to the placement of elements, color combinations, and overall aesthetic.";
        }

        // Store the current layout as previous layout before updating
        if (session('preview_content')) {
            session(['previous_layout' => session('preview_content')]);
        }
        if (session('code_content')) {
            session(['previous_code' => session('code_content')]);
        }

        // Get current preview content if it exists
        $currentPreview = session('preview_content');
        $currentCode = session('code_content');
         // Retrieve the history stack or initialize it
            $history = session('layout_history', []);

        // Push current state onto the history stack if it exists
            if ($currentPreview && $currentCode) {
                $history[] = [
                    'preview' => $currentPreview,
                    'code' => $currentCode,
                ];
                session(['layout_history' => $history]);
            }

        // ai prompt
  
        
        $systemPrompt = <<<EOT
                    You are an expert in Bootstrap and modern web application development.

                    General Rules:

                    - Use Bootstrap 5.3.3 (latest stable) via CDN.

                    - No jQuery unless explicitly requested.

                    - Use semantic HTML5 (<header>, <main>, <section>, <footer>) for meaningful structure.

                    - Ensure responsiveness with Bootstrap grid (.container, .row, .col-*) and utilities.

                    - Avoid custom CSS; prefer Bootstrap utilities (mt-3, px-2, text-center, d-flex, justify-content-center, bg-primary, text-white, etc.) to create a vibrant, modern colored theme with harmonious text colors for readability.

                    - Include Bootstrap CSS/JS and Bootstrap Icons via CDN:

                        CSS: https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css

                        JS: https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js

                        Icons: https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css

                    Modern Website Layout Design Using Bootstrap Components:

                    - Structure the page with semantic sections: a sticky-top navbar, a responsive hero section, content cards, forms, carousels/sliders, and a multi-column footer.

                    - Use the Bootstrap navbar component with .navbar-expand-lg, .navbar-dark, and a vibrant background (e.g., bg-primary) for a modern navigation experience, including accessible toggler buttons and right-aligned nav links with .ms-auto.

                    - Implement a hero section using Bootstrap’s grid and utilities, featuring a prominent heading, descriptive text, call-to-action buttons styled with .btn-primary and .btn-outline-light, and a responsive image with .img-fluid and loading="lazy".

                    - Present key content in responsive Bootstrap cards with .shadow-lg, .rounded, and colored headers or footers using contextual background classes (bg-primary, bg-secondary) paired with contrasting text colors (text-white).

                    - Use Bootstrap Carousel for dynamic sliders with indicators and controls, ensuring images are responsive (.d-block w-100) and lazy-loaded.

                    - Design modern forms using .form-floating for floating labels, with validation states (.is-valid, .is-invalid) and Bootstrap alerts for feedback, ensuring accessibility with proper labels and ARIA attributes.

                    - Create a responsive, multi-column footer using Bootstrap grid (.container, .row, .col-*) with sections such as About, Links, Contact, and Social Media, styled with bg-primary and text-white, including Bootstrap Icons with spacing (.me-2).

                    - Ensure consistent spacing and alignment throughout using Bootstrap utilities (mt-3, mb-4, p-3, d-flex, justify-content-between).

                    Image Handling and Accessibility:

                    - Use fully qualified CDN-hosted image URLs to guarantee proper loading.

                    - Apply .img-fluid and .rounded or .img-thumbnail for responsive, styled images.

                    - Add loading="lazy" and meaningful alt attributes for performance and accessibility.

                    - Implement image preview modals with Bootstrap modal components and vanilla JavaScript event listeners that dynamically update modal image sources on click, including ARIA attributes for accessibility.

                    Interactivity and User Experience:

                    - Incorporate micro-interactions such as hover and focus effects on buttons and links using .link-primary, .hover-shadow, and smooth transitions.

                    - Support dark mode by toggling data-bs-theme="dark" on <html> and switching component classes accordingly (e.g., navbar-dark bg-dark, text-light).

                    Code Output:

                    - Return full HTML documents with <!DOCTYPE html>, <html>, <head>, <body>.

                    - Include only necessary JS for interactive components.

                    - Use clean indentation and inline comments (e.g., <!-- Navbar -->, <!-- Hero Section -->, <!-- Card Layout -->, <!-- Carousel -->, <!-- Form -->, <!-- Footer -->).

                    When a reference image is provided:
                    - Analyze the layout, color scheme, and visual hierarchy
                    - Match the design elements and structure as closely as possible
                    - Maintain the same visual style while ensuring responsive design
                    - Use Bootstrap components that best represent the reference design
                   
                    Prompt Interpretation and Validation:

                    - Only accept prompts that are valid natural language descriptions clearly expressing an intent to create a webpage or webpage section.

                    - Reject prompts that:
                    - Consist of random or nonsensical characters (e.g., "asdf", "xckjwe")
                    - Lack verbs or structural meaning
                    - Do not pertain to webpage generation (e.g., generic questions or unrelated phrases)
                    
                    Subpage and Inner Page Generation:

                    - When the prompt indicates a specific subpage or inner page (e.g., "About Us", "Contact", "Services", "Product Details", "Team", "FAQs"), generate a full HTML page representing that section of the site.

                    - Apply consistent styling and layout conventions as used in the main homepage (e.g., navbar, footer), ensuring the subpage feels visually cohesive with the overall site.

                    - Include relevant Bootstrap components for the page type:
                        - Contact Page: form-floating inputs, contact details, map iframe placeholder, and alerts for feedback.
                        - About/Team Page: responsive cards with team member info, mission statement section.
                        - Product/Service Pages: Bootstrap cards, accordions, tabs, or carousels for showcasing features.
                        - FAQ Page: use accordions with questions as headers and answers inside collapsible sections.

                    - Subpages must follow the same rules for responsiveness, accessibility, semantic structure, and Bootstrap 5.3.3 usage.

                    - Clearly indicate in HTML comments (e.g., <!-- About Us Section -->, <!-- Contact Form -->) the specific purpose of each section to aid developer understanding and reuse.
    
                    Resources & Best Practices:

                    - Reference https://getbootstrap.com/ for official classes and components.

                    - Use official Bootstrap and Bootstrap Icons CDN links.

                    - Use lazy loading on images.

                    - Follow mobile-first, accessibility, and performance best practices to deliver a modern, professional, and visually harmonious web experience.
                    
 
                EOT;
       


        // Add current preview content to the prompt if it exists
        $fullPrompt = $systemPrompt . "\n\n";
        if ($currentPreview) {
            $fullPrompt .= "Current HTML Layout:\n" . $currentPreview . "\n\n";
        }
        $fullPrompt .= "User: " . $prompt;
          
        try {
             $result = Gemini::generativeModel(model: 'gemini-2.0-flash')
                ->generateContent($fullPrompt);
            
            // $htmlContent = $result->text();
            
            // // Clean up the HTML content
            // $htmlContent = str_replace(['```html', '```'], '', $htmlContent);
            
            // // Format the HTML code for display
            // $previewContent = $htmlContent;

            $htmlContent = $result->text();

        // Extract only the <html>...</html> content

        $htmlContent =str_replace(['```html', '```'], '', $htmlContent); 
        if (preg_match('/<html\b[^>]*>.*<\/html>/is', $htmlContent, $matches)) {
            $previewContent = $matches[0] ;
             
        } else {
            // Fallback: remove markdown-style code fences if <html> tag is missing
            $previewContent = str_replace(['```html', '```'], '', $htmlContent); 
             
        }
           
            // Format the code with syntax highlighting
            ob_start();
            highlight_string( $previewContent); //  highlight_string( $htmlContent);
            $highlightedCode = ob_get_clean();
             
             // Clean up the highlighted code
            $highlightedCode = str_replace(['<code>', '</code>'], '', $highlightedCode);
            
             
            // Store in session
            session(['preview_content' => $previewContent]);
            session(['code_content' => $highlightedCode]);
            
            return redirect()->route('ai.show')
                ->with('success', 'Layout design updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update layout: ' . $e->getMessage());
        }
    }
 
    public function downloadZip(Request $request)
    {
        $previewContent = session('preview_content');
        if (!$previewContent) {
            return redirect()->back()->with('error', 'No content to download');
        }

        // Create a temporary directory
        $tempDir = sys_get_temp_dir() . '/theme-' . uniqid();
        mkdir($tempDir);

        // Create index.html
        $indexContent = $previewContent;
        
        // Add Bootstrap CSS and JS
        $indexContent = str_replace('</head>', "
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css' rel='stylesheet'>
        </head>", $indexContent);

        $indexContent = str_replace('</body>', "
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
        </body>", $indexContent);

        file_put_contents($tempDir . '/index.html', $indexContent);

        // Create ZIP file
        $zip = new \ZipArchive();
        $zipFile = $tempDir . '/theme.zip';
        if ($zip->open($zipFile, \ZipArchive::CREATE) !== true) {
            return redirect()->back()->with('error', 'Failed to create ZIP file');
        }

        $zip->addFile($tempDir . '/index.html', 'index.html');
        $zip->close();

        // Return ZIP file for download
        return response()->download($zipFile, 'theme.zip')
            ->deleteFileAfterSend(true);
    }

    public function clearPreview(Request $request)  
    {
        session()->forget('preview_content');
        session()->forget('code_content');
        session()->forget('layout_history'); // <-- Clear the layout history too

        return response()->json(['success' => true]);
    }
}
 
  
  

