<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class PromptProcessor
{
    private $componentKeywords = [
        'header' => ['header', 'topbar', 'navigation', 'nav', 'menu', 'top navigation', 'header section'],
        'hero' => ['hero', 'banner', 'main image', 'featured image', 'hero section', 'main banner'],
        'carousel' => ['carousel', 'slider', 'slideshow', 'image slider', 'photo gallery'],
        'faq' => ['faq', 'questions', 'answers', 'frequently asked questions', 'help center'],
        'footer' => ['footer', 'bottom', 'footer menu', 'bottom section', 'footer section'],
        'form' => ['form', 'input', 'fields', 'submission', 'contact form', 'registration form'],
        'modal' => ['modal', 'popup', 'dialog', 'overlay', 'lightbox', 'modal window'],
        'sidebar' => ['sidebar', 'aside', 'secondary', 'side menu', 'left menu'],
        'testimonial' => ['testimonial', 'reviews', 'ratings', 'testimonials', 'customer reviews'],
        'text' => ['text', 'content', 'paragraph', 'copy', 'main content', 'page content'],
        'image' => ['image', 'photo', 'picture', 'visual', 'gallery', 'image gallery'],
        'button' => ['button', 'cta', 'action', 'call to action', 'submit button'],
        'card' => ['card', 'box', 'container', 'block', 'feature card', 'product card'],
        'dropdown' => ['dropdown', 'select', 'menu', 'dropdown menu', 'select menu'],
        'chat' => ['chat', 'chatbot', 'live chat', 'customer support', 'chat window'],

    ];

    public function extractKeywords($prompt)
    {
        $keywords = [];
        $promptLower = strtolower($prompt);
        
        // Check for exact matches of multi-word phrases
        foreach ($this->componentKeywords as $component => $synonyms) {
            foreach ($synonyms as $synonym) {
                // Check if the synonym exists as a phrase in the prompt
                if (strpos($promptLower, $synonym) !== false) {
                    $keywords[] = $component;
                    break;
                }
            }
        }
        
        // Also check individual words
        $words = preg_split('/\s+/', $promptLower);
        foreach ($words as $word) {
            foreach ($this->componentKeywords as $component => $synonyms) {
                if (in_array($word, $synonyms)) {
                    $keywords[] = $component;
                }
            }
        }
        
        return array_unique($keywords);
    }

    public function mapKeywordsToComponents($keywords)
    {
        $mappedComponents = [];
        
        // First check for exact matches
        foreach ($keywords as $keyword) {
            if (isset($this->componentKeywords[$keyword])) {
                $mappedComponents[] = $keyword;
            }
        }
        
        // Then check for synonyms
        foreach ($keywords as $keyword) {
            foreach ($this->componentKeywords as $component => $synonyms) {
                // Check if the keyword matches any synonym
                if (in_array($keyword, $synonyms)) {
                    $mappedComponents[] = $component;
                    break;
                }
                
                // Check if the keyword contains any synonym
                foreach ($synonyms as $synonym) {
                    if (strpos($keyword, $synonym) !== false) {
                        $mappedComponents[] = $component;
                        break 2;
                    }
                }
            }
        }
        
        return array_unique($mappedComponents);
    }

    /*
    public function checkExistingComponents($components)
    {
        $existingComponents = [];
    
        // Get all component directories and files
        $componentPath = resource_path('views/components');
        $allComponents = File::directories($componentPath);
        $allFiles = File::files($componentPath);
        
        foreach ($components as $component) {    

            // Try different variations of the component name
            $variations = [
                $component,  // exact match
                ucfirst($component),  // capitalized
                strtolower($component),  // lowercase
                ucfirst(strtolower($component)),  // proper case
                $component . 's',  // plural
                ucfirst($component . 's'),  // plural capitalized
            ];
            
            // Check if any variation exists as a directory
            foreach ($variations as $variation) {   
                $componentDir = resource_path("views/components/{$variation}");
                
                if (file_exists($componentDir)) {
                    // Get all .blade.php files in the directory
                    $bladeFiles = File::glob("{$componentDir}/*.blade.php");
                   
                    // If any blade files exist, consider the component as existing
                    if (!empty($bladeFiles)) {
                        $existingComponents[] = $component;
                        break;
                    }
                }
            }
           
            // Check if any variation exists as a direct blade file
            foreach ($variations as $variation) {
                $componentFile = resource_path("views/components/{$variation}.blade.php");
                if (file_exists($componentFile)) {
                    $existingComponents[] = $component;
                    break;
                }
            }
            
        }
       echo "Exiasting components:"; exit;
        return array_unique($existingComponents);
    }
    */

    public function checkExistingComponents($components)
    {
        $existingComponents = [];
    
        // Get all component directories and files
        $componentPath = resource_path('views/components');
        $allComponents = File::directories($componentPath);
        $allFiles = File::files($componentPath);
        
        foreach ($components as $component) {    

            // Try different variations of the component name
            $variations = [
                $component,  // exact match
                ucfirst($component),  // capitalized
                strtolower($component),  // lowercase
                ucfirst(strtolower($component)),  // proper case
                $component . 's',  // plural
                ucfirst($component . 's'),  // plural capitalized
            ];
            
            // Check if any variation exists as a directory
         /* foreach ($variations as $variation) {   
                $componentDir = resource_path("views/components/{$variation}");
                
               
                if (file_exists($componentDir)) {
                    // Get all .blade.php files in the directory
                    $bladeFiles = File::glob("{$componentDir}/*.blade.php");
                   
                    // If any blade files exist, consider the component as existing
                    if (!empty($bladeFiles)) {
                        $existingComponents[] = $component;
                        break;
                    }
                }
            }   */
              
            $componentsBaseDir = resource_path('views/components');

            foreach ($variations as $variation) {

                // Get all subdirectories inside components directory
                $subDirs = File::directories($componentsBaseDir);
            
                foreach ($subDirs as $subDir) {
                    // Get the folder name from the full path
                    $folderName = basename($subDir);
            
                    // Check if folder name contains the variation string
                    if (stripos($folderName, $variation) !== false) {
                        // Check for blade files inside this folder
                        $bladeFiles = File::glob("{$subDir}/*.blade.php");
            
                        if (!empty($bladeFiles)) {
                            $existingComponents[] = $component;
                            break; // Stop checking other folders for this variation
                        }
                    }
                }
            }

            
        //   foreach ($variations as $variation) {
        //     $baseDir = resource_path("views/components");
        
        //     // Get all subdirectories in the components directory
        //     $subDirs = File::directories($baseDir);
        
        //     foreach ($subDirs as $subDir) {
        //         // Check if the folder name contains the variation string
        //         if (str_contains(basename($subDir), $variation)) {
        //             $bladeFiles = File::glob("{$subDir}/*.blade.php");
         
        //             if (!empty($bladeFiles)) {
        //                 $existingComponents[] = $subDir;
        //                 // Optional: break if you want only one match per variation
        //                 break;
        //             }
        //         }
        //     }
        // }
            // Check if any variation exists as a direct blade file
            foreach ($variations as $variation) {
                $componentFile = resource_path("views/components/{$variation}.blade.php");
                if (file_exists($componentFile)) {
                    $existingComponents[] = $component;
                    break;
                }
            }
            
        }

        
        return array_unique($existingComponents);
    }

    public function generateHTMLContent($layout)
    {
        $html = "";
        
        // Generate HTML based on layout structure
        foreach ($layout['structure'] as $section) {
            if (isset($layout['components'][$section])) {
                $component = $layout['components'][$section];
                
                // Get the component's Blade template
                $componentFile = resource_path("views/components/{$component['type']}.blade.php");
                
                if (file_exists($componentFile)) {
                    // Include the component's Blade template
                    $html .= "@include('components.{$component['type']}', [
                        'position' => '{$component['position']}',
                        'priority' => {$component['priority']}
                    ])";
                } else {
                    // Fallback to a generic component structure
                    $html .= "<div class='component {$component['type']}' data-position='{$component['position']}' data-priority='{$component['priority']}'>";
                    $html .= "<h3>{$component['type']} Component</h3>";
                    $html .= "<p>Generated HTML for {$component['type']} component</p>";
                    $html .= "</div>";
                }
            }
        }
        
        return $html;
    }

    public function processPrompt($prompt, $existingLayout = null)
    {
        
        Log::info('Processing prompt: ' . $prompt);
        
        // Extract keywords from prompt
        $keywords = $this->extractKeywords($prompt);
        Log::info('Extracted keywords: ' . json_encode($keywords));
       
        // Map keywords to components
        $mappedComponents = $this->mapKeywordsToComponents($keywords);
        Log::info('Mapped components: ' . json_encode($mappedComponents)); 

        // Check which components exist in the components directory
        $existingComponents = $this->checkExistingComponents($mappedComponents);
        Log::info('Existing components: ' . json_encode($existingComponents));
 
        // Generate layout structure based on components
        $layout = $this->generateLayout($existingComponents, $existingLayout);

        Log::info('Generated layout: ' . json_encode($layout));
         return [
            'keywords' => $keywords,
            'mapped_components' => $mappedComponents,
            'existing_components' => $existingComponents,
            'layout' => $layout
        ];
    }

    private function generateLayout($components, $existingLayout = null)
    {
        // Initialize layout structure
        $layout = [
            'structure' => [],
            'sections' => [],
            'components' => []
        ];

        // If existing layout is provided, merge it with our base structure
        if ($existingLayout) {
            // Ensure all required keys exist in existing layout
            $layout['structure'] = $existingLayout['structure'] ?? [];
            $layout['sections'] = $existingLayout['sections'] ?? [];
            $layout['components'] = $existingLayout['components'] ?? [];
        }

        // Sort components by their typical placement in a layout
        $sortedComponents = $this->sortComponents($components);

        // Default priorities for components (standard webpage layout)
        $priorities = [
            'header' => 1,        // Top of the page
            'hero' => 2,         // Main hero section
            'carousel' => 3,     // Main content area
            'sidebar' => 4,      // Left or right side
            'form' => 13,         // Main content area
            'text' => 6,         // Main content area
            'image' => 7,        // Main content area
            'card' => 8,         // Main content area
            'button' => 9,       // Main content area
            'testimonial' => 10, // Content section
            'faq' => 11,         // Content section
            'dropdown' => 12,    // Navigation elements
            'modal' => 5,       // Overlay elements
            'footer' => 14 ,
            'chat' => 15,    // Bottom of the page
        ];

        // Process new components
        foreach ($sortedComponents as $component) {  
           
            // Skip if component already exists in layout
            if (isset($layout['components'][$component])) {  
                continue;
            }

            // Get default position and priority
            $position = 'content';
            $priority = $priorities[$component] ?? 100;

            // Special cases for specific components
             
            switch ($component) { 
                case 'header':
                    $position = 'top';
                    break;
                case 'hero':
                    $position = 'main';
                    break;
                case 'carousel':
                    $position = 'main';
                    break;
                case 'form':
                    $position = 'main';
                    break;
                case 'sidebar':
                    $position = 'left';
                    break;
                case 'footer':
                    $position = 'bottom';
                    break;
                case 'chat':
                        $position = 'right';
                        break;
            }

            // Find the correct insertion point based on priority
            $insertIndex = count($layout['structure']);
            foreach ($layout['components'] as $existingComponent => $existingData) {
                if ($priority < $existingData['priority']) {
                    $insertIndex = array_search($existingComponent, $layout['structure']);
                    break;
                }
            }

            // Insert at the correct position
            array_splice($layout['structure'], $insertIndex, 0, $component);
            array_splice($layout['sections'], $insertIndex, 0, $position);
            $layout['components'][$component] = [
                'type' => $component,
                'position' => $position,
                'priority' => $priority
            ];
        }
 
        return $layout;
    }

    private function sortComponents($components)
    {
        // Define the typical order of components in a layout
        $componentOrder = [
            'header', 'hero', 'carousel', 'sidebar', 'faq', 'testimonial',
            'text', 'image', 'button', 'card', 'dropdown', 'modal', 'form','footer','chat',
        ];

        // Sort components based on their typical position
        usort($components, function($a, $b) use ($componentOrder) {
            $posA = array_search($a, $componentOrder);
            $posB = array_search($b, $componentOrder);
            
            // If component not found in order array, put it at the end
            if ($posA === false) {
                $posA = count($componentOrder) + 1;
            }
            if ($posB === false) {
                $posB = count($componentOrder) + 1;
            }
            
            return $posA - $posB;
        });

        return $components;
    }
}
