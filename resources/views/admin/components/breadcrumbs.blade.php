@if(isset($breadcrumbs) && count($breadcrumbs) > 0)
<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        @foreach($breadcrumbs as $key => $breadcrumb)
        @if($key === array_key_last($breadcrumbs))
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">
                    {{ $breadcrumb['title'] }}
                </span>
            </div>
        </li>
        @else
        <li>
            <a href="{{ $breadcrumb['url'] ?? '#' }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                {{ $breadcrumb['title'] }}
            </a>
        </li>
        @endif
        @endforeach
    </ol>
</nav>
@endif