<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;


use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PromptHistory;
use App\Services\PromptProcessor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ProjectNewController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('projects_new.index', compact('projects'));
    }

    


    public function create()
    {
        return view('projects_new.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'prompt' => 'required|string',
            'preview_data' => 'nullable|array'
        ]);
        
        $prompt = $validated['prompt'];
        
        $processor = new PromptProcessor();
        $processed = $processor->processPrompt($prompt);
        
        $previewData = $this->generatePreviewData($processed['layout']);
        
        if($previewData['components'])
        {

                $project = Project::create([
                'title' => Str::title($prompt),
                'prompt' => $prompt,
                'layout' => $processed,
                'preview_data' => $previewData,
                'html_content' => $previewData['html_content'],

                'keywords' => $processed['keywords'],
                'components' => $processed['mapped_components'],
                'existing_components' => $processed['existing_components'],
                'description'  =>'Project created from prompt: '.$prompt,
                
            ]);

            \Log::info('Project created with data:', [
                'keywords' => $project->keywords,
                'components' => $project->components,
                'existing_components' => $project->existing_components,
                'layout' => $project->layout
            ]);

            PromptHistory::create([
                'project_id' => $project->id,
                'prompt' => $prompt,
                'keywords' => $processed['keywords'],
                'components' => $processed['mapped_components'],
                'existing_components' => $processed['existing_components'],
                'layout' => $processed['layout'],
                'preview_data' => $previewData
            ]);

            return redirect()->route('projects_new.show', $project)
                ->with('success', 'Project created successfully')
                ->with('preview_data', $previewData);
        }else{
            return redirect()->route('projects_new.index' )
            ->with('success', 'Project layouts not found')
            ->with( $prompt);
           
        }
    }
 

public function show(Project $project)
{
    // Fetch all prompt histories
    $promptHistories = $project->promptHistories()->latest()->get();

    // Fetch the latest preview_data from prompt history
    $latestPreviewData = optional($promptHistories->first())->preview_data;

    return view('projects_new.show', compact('project', 'promptHistories', 'latestPreviewData'));
}

 /*
        public function showHistory($historyId)
    {
        $history = PromptHistory::findOrFail($historyId);

        $html = view('projects_new.partials.preview_section', [
            'components' => $history->preview_data['components'] ?? []
        ])->render();

        return response()->json([
            'preview_html' => $html
        ]);
    }
 
*/ 
public function showHistory($historyId)
{
    $history = PromptHistory::findOrFail($historyId);

    $components = $history->preview_data['components'] ?? [];

    // Step 1: Extract blade file paths from preview_data['html_content']
    $bladePaths = [];
    $rawFileContents = [];

    $htmlContent = $history->preview_data['html_content'] ?? null;

    if (!empty($htmlContent)) {
        preg_match_all('/Blade file path:\s*(.*?\.blade\.php)/', $htmlContent, $matches);
        $bladePaths = $matches[1] ?? [];

        foreach ($bladePaths as $absolutePath) {
            $fullPath = base_path('resources/views/' . str_replace(['views/', '.blade.php'], ['', ''], $absolutePath) . '.blade.php');

            if (file_exists($fullPath)) {
                $rawFileContents[] = [
                    'filename' => basename($fullPath),
                    'path' => $fullPath,
                    'code' => file_get_contents($fullPath),
                ];
            }
        }
    }

    // Render the preview and HTML code views
    $htmlPreview = view('projects_new.partials.preview_section', compact('components'))->render();

    $htmlCode = view('projects_new.partials.html_section', [
        'rawFileContents' => $rawFileContents
    ])->render();

    return response()->json([
        'preview_html' => $htmlPreview,
        'html_code' => $htmlCode
    ]);
}

 

    
    public function generatePreview(Request $request)
    {
        $prompt = $request->input('prompt');
        $projectId = $request->input('project_id');
        $project = Project::findOrFail($projectId);
        
        $processor = new PromptProcessor();
        $processed = $processor->processPrompt($prompt);

        $previewData = $this->generatePreviewData($processed['layout']);

        return response()->json($previewData);
    }

    public function editPrompt(Project $project)
    {
        return view('projects_new.edit-prompt', compact('project'));
    }
 
   
public function updatePrompt(Request $request, Project $project)
{
    $validated = $request->validate([
        'prompt' => 'required|string',
        'preview_data' => 'nullable|array'
    ]);

    // ai prompt
    /*  $systemPrompt = <<<EOT
    You are an expert in Bootstrap and modern web application development.
    
    General Development Rules:
    - Use Bootstrap 5 or the latest stable version.
    - Do NOT use jQuery unless explicitly asked.
    - Use semantic HTML5 elements (e.g., <header>, <main>, <section>, <footer>).
    - Ensure responsiveness using Bootstrap’s grid system (.container, .row, .col-*) and utility classes.
    - Avoid custom CSS unless absolutely required — use Bootstrap utility classes like mt-3, px-2, text-center, etc.
    - Include Bootstrap via CDN (mention where necessary).
    
    Component Design Rules:
    - Use Bootstrap-native components for buttons, cards, forms, modals, navbars, etc.
    - Use `.form-floating`, `.form-group`, `.is-valid`, `.is-invalid`, and alerts for proper validation.
    - Stick to layout best practices using `.container`, `.container-fluid`, `.row`, `.col-*`.
    - If icons are needed, use Bootstrap Icons via CDN.
    
     Code Output Rules:
    - Return full, working HTML (with <!DOCTYPE html>, <html>, <head>, <body>) unless partials are explicitly requested.
    - Include only necessary JavaScript (for components like modals, collapses, or carousels).
    - Format code with clean indentation.
    - Use inline HTML comments to label sections (e.g., <!-- Navbar -->, <!-- Footer -->, <!-- Login Form -->).
    
     Optional Rules for Production/Live Use:
    - Always consider accessibility: use ARIA attributes for interactive elements.
    - Use a mobile-first approach (Bootstrap is mobile-first by default).
    - Avoid inline styles and prefer utility classes for styling and spacing.
    
    Always return clean, valid, copy-paste-ready HTML using only Bootstrap conventions and structure.
    EOT;

   $prompt = $validated['prompt'];
 $fullPrompt = $systemPrompt . "\n\nUser: " . $prompt;

 $result = Gemini::generativeModel(model: 'gemini-2.0-flash')
     ->generateContent($fullPrompt); 
   
   //  $prompt=$result->text();
   $prompt = $validated['prompt'];
*/
   // ai prompt
    
   $prompt = $validated['prompt'];
    // Get the latest layout from history (if it exists)
    $latestHistory = $project->promptHistories()->latest()->first();
    $existingLayout = $latestHistory?->layout ?? null;

    $processor = new PromptProcessor();

    // Pass the correct layout
    $processed = $processor->processPrompt($prompt, $existingLayout);

    $previewData = $this->generatePreviewData($processed['layout']);

    PromptHistory::create([
        'project_id' => $project->id,
        'prompt' => $prompt,
        'keywords' => $processed['keywords'],
        'components' => $processed['mapped_components'],
        'existing_components' => $processed['existing_components'],
        'layout' => $processed['layout'],
        'preview_data' => $previewData
    ]);

    return back()->with([
        'success' => 'Prompt updated successfully',
        'preview_data' => $previewData
    ]);
}

    private function generatePreviewData($layout)
    {
        
        // Initialize preview data structure
        $previewData = [
            'title' => 'Generated Preview',
            'sections' => [],
            'components' => [],
            'layout' => [
                'structure' => $layout['structure'],
                'components' => $layout['components']
            ]
        ];

        // Process layout structure
        foreach ($layout['structure'] as $section) {    
            if (isset($layout['components'][$section])) { 
                $component = $layout['components'][$section];

                // Find component blade file
                $componentFile = null;
                
                // First check in any subfolder that contains the component type
                $componentType = $component['type'];
                $componentsPath = resource_path('views/components');
                
                // Get all subfolders in components directory
                $subfolders = File::directories($componentsPath);
                $isInSubfolder = false;
                $subfolderName = '';
                
                // Check each subfolder
                foreach ($subfolders as $subfolder) {
                    $subfolderName = basename($subfolder);
                    
                    // Check if subfolder name contains the component type
                    if (strpos($subfolderName, $componentType) !== false) {
                        $isInSubfolder = true;
                        $subfolderFiles = File::files($subfolder);
                        foreach ($subfolderFiles as $file) {
                           
                            $fileName = $file->getRelativePathname();
                            
                            if (strpos($fileName, '.blade.php') !== false) {
                                $componentFile = $fileName;
                                break 2; // Break out of both loops
                            }
                        }
                    }
                }

                // If not found in subfolder, check in root components folder
                if (!$componentFile) {
                    $rootComponentFile = resource_path("views/components/{$component['type']}.blade.php");
                    if (file_exists($rootComponentFile)) {
                        $componentFile = str_replace(resource_path('views/'), '', $rootComponentFile);
                        $isInSubfolder = false;
                    }
                }

                // Add section if it doesn't exist
                if (!in_array($component['position'], $previewData['sections'])) {
                    $previewData['sections'][] = $component['position'];
                }

                // Add component with blade file path
                $previewData['components'][] = [
                    'type' => $component['type'],
                    'position' => $component['position'],
                    'priority' => $component['priority'],
                    'content' => "Preview of {$component['type']} component",
                    'blade_file' => $componentFile,
                    'full_path' => $isInSubfolder 
                        ? "views/components/{$subfolderName}/" . basename($componentFile)
                        : "views/components/" . basename($componentFile)
                ];
            }
           
        }  
        
        // Generate HTML content
        $htmlContent = $this->generateHTMLContent($previewData['components']);
        $previewData['html_content'] = $htmlContent;
        
        return $previewData;
    }

    private function generateHTMLContent($components)
    {
        $html = "";
 
        // Process each component
        foreach ($components as $component) {  

            if (!empty($component['blade_file']))    {  
                // Get the blade file path relative to views directory
                //$bladePath = str_replace(resource_path('views/'), '', $component['blade_file']);
                //print_r( $bladePath );echo "<br/><br/>";
                
                // Store the blade file path with full path
                $html .= "<!-- {$component['type']} component -->\n";
                $html .= "<!-- Blade file path: " . $component['full_path'] . " -->\n";
                
                // Add section information
                $html .= "<!-- Section: {$component['position']} -->\n";
                $html .= "<!-- Priority: {$component['priority']} -->\n\n";

               
            }
        }
         return $html;
    }

    public function deletePromptHistory(string $id)
    {
        $project_id = PromptHistory::where('id', $id)->value('project_id');

        $history = PromptHistory::findOrFail($id);
        $history->delete();
        
         $counts = PromptHistory::where('project_id', $project_id)->count();
         if($counts==0){
            Project::where('id',$project_id)->delete();
         }
         
        return response()->json([
            'success' => true,
            'message' => 'Prompt deleted successfully',
            'counts' => $counts ,
        ]);
    }

    public function updateHtmlContent(Project $project, Request $request)
    {
        $request->validate([
            'html_content' => 'required|string',
        ]);

        $project->update([
            'custom_html_content' => $request->html_content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'HTML content updated successfully'
        ]);
    }
}
