<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $title ?? __('Page Title') }}</h1>
            @if(isset($subtitle))
            <p class="mt-1 text-sm text-gray-600">{{ $subtitle }}</p>
            @endif
        </div>

        @if(isset($actions) && count($actions) > 0)
        <div class="flex space-x-3">
            @foreach($actions as $action)
            @if($action['type'] === 'link')
            <a href="{{ $action['url'] }}"
                class="inline-flex items-center px-4 py-2 bg-{{ $action['color'] ?? 'blue' }}-600 text-white text-sm font-medium rounded-lg hover:bg-{{ $action['color'] ?? 'blue' }}-700 transition-colors">
                @if(isset($action['icon']))
                <i class="{{ $action['icon'] }} mr-2"></i>
                @endif
                {{ $action['title'] }}
            </a>
            @elseif($action['type'] === 'button')
            <button onclick="{{ $action['onclick'] ?? '' }}"
                class="inline-flex items-center px-4 py-2 bg-{{ $action['color'] ?? 'blue' }}-600 text-white text-sm font-medium rounded-lg hover:bg-{{ $action['color'] ?? 'blue' }}-700 transition-colors">
                @if(isset($action['icon']))
                <i class="{{ $action['icon'] }} mr-2"></i>
                @endif
                {{ $action['title'] }}
            </button>
            @elseif($action['type'] === 'dropdown')
            <div class="relative">
                <button onclick="toggleActionDropdown('{{ $action['id'] ?? 'dropdown' }}')"
                    class="inline-flex items-center px-4 py-2 bg-{{ $action['color'] ?? 'gray' }}-600 text-white text-sm font-medium rounded-lg hover:bg-{{ $action['color'] ?? 'gray' }}-700 transition-colors">
                    @if(isset($action['icon']))
                    <i class="{{ $action['icon'] }} mr-2"></i>
                    @endif
                    {{ $action['title'] }}
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>
                <div id="{{ $action['id'] ?? 'dropdown' }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                    @foreach($action['items'] as $item)
                    @if($item['type'] === 'link')
                    <a href="{{ $item['url'] }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        @if(isset($item['icon']))
                        <i class="{{ $item['icon'] }} mr-2"></i>
                        @endif
                        {{ $item['title'] }}
                    </a>
                    @elseif($item['type'] === 'divider')
                    <div class="border-t border-gray-200 my-1"></div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>
</div>

<script>
    function toggleActionDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('hidden');

        // Close other dropdowns
        document.querySelectorAll('[id^="dropdown"]').forEach(el => {
            if (el.id !== id) {
                el.classList.add('hidden');
            }
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[onclick*="toggleActionDropdown"]')) {
            document.querySelectorAll('[id^="dropdown"]').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });
</script>