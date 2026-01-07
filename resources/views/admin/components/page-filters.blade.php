@if(isset($filters) && count($filters) > 0)
<div class="bg-white rounded-lg shadow p-4 mb-6 border border-gray-200">
    <form method="GET" action="{{ request()->url() }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ $filters['columns'] ?? 3 }} gap-4">
            @foreach($filters['fields'] as $field)
            <div>
                @if($field['type'] === 'text')
                <label for="{{ $field['name'] }}" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ $field['label'] }}
                </label>
                <input type="text"
                    id="{{ $field['name'] }}"
                    name="{{ $field['name'] }}"
                    value="{{ request()->get($field['name']) }}"
                    placeholder="{{ $field['placeholder'] ?? '' }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                @elseif($field['type'] === 'select')
                <label for="{{ $field['name'] }}" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ $field['label'] }}
                </label>
                <select id="{{ $field['name'] }}"
                    name="{{ $field['name'] }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @if(isset($field['placeholder']))
                    <option value="">{{ $field['placeholder'] }}</option>
                    @endif
                    @foreach($field['options'] as $value => $label)
                    <option value="{{ $value }}" {{ request()->get($field['name']) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>

                @elseif($field['type'] === 'date')
                <label for="{{ $field['name'] }}" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ $field['label'] }}
                </label>
                <input type="date"
                    id="{{ $field['name'] }}"
                    name="{{ $field['name'] }}"
                    value="{{ request()->get($field['name']) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                @elseif($field['type'] === 'checkbox')
                <div class="flex items-center">
                    <input type="checkbox"
                        id="{{ $field['name'] }}"
                        name="{{ $field['name'] }}"
                        value="1"
                        {{ request()->get($field['name']) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="{{ $field['name'] }}" class="ml-2 block text-sm text-gray-700">
                        {{ $field['label'] }}
                    </label>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="flex justify-between items-center">
            <div class="flex space-x-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-filter mr-2"></i>{{ __('Apply Filters') }}
                </button>
                <a href="{{ request()->url() }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition-colors">
                    <i class="fas fa-times mr-2"></i>{{ __('Clear') }}
                </a>
            </div>

            @if(isset($filters['export']))
            <button type="button" onclick="{{ $filters['export']['onclick'] }}" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-download mr-2"></i>{{ __('Export') }}
            </button>
            @endif
        </div>
    </form>
</div>
@endif