<div class="p-2">
    @if (!empty($rawFileContents))
        <div class="component-source-codes">
            @foreach ($rawFileContents as $file)
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
        <textarea rows="10" class="w-full p-4 bg-gray-50 rounded-lg border focus:ring-0 resize-none"
                  placeholder="HTML code will appear here..."></textarea>
    @endif
</div>

{{-- Live preview output --}}
<div id="live-preview" class="border p-4 rounded mt-6 bg-white shadow"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editors = document.querySelectorAll('.editable-html');
        const preview = document.getElementById('live-preview');

        editors.forEach(editor => {
            editor.addEventListener('input', () => {
                // Combine HTML from all textareas if there are multiple
                let combinedHtml = '';
                editors.forEach(e => {
                    combinedHtml += e.value + '\n';
                });
                preview.innerHTML = combinedHtml;
            });
        });

        // Trigger initial render
        if (editors.length > 0) {
            let initialHtml = '';
            editors.forEach(e => {
                initialHtml += e.value + '\n';
            });
            preview.innerHTML = initialHtml;
        }
    });
</script>
