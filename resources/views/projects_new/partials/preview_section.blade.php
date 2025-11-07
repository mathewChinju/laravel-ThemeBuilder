<div class="space-y-4">
    @php
        $sections = [];
        foreach($components as $component) {
            if (!isset($sections[$component['position']])) {
                $sections[$component['position']] = [];
            }
            $sections[$component['position']][] = $component;
        }

        use Illuminate\Support\Facades\File;
    @endphp

    @foreach($sections as $position => $componentsGroup)
        <div class="mb-6">
            <div class="grid gap-6">
                @foreach($componentsGroup as $component)
                    @if($component['blade_file'])
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



</div> 