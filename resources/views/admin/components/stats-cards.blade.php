@if(isset($stats) && count($stats) > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    @foreach($stats as $key => $stat)
    <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-{{ $stat['color'] ?? 'blue' }}-500 rounded-lg flex items-center justify-center">
                    <i class="{{ $stat['icon'] ?? 'fas fa-chart-bar' }} text-white text-sm"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stat['value']) }}</p>
                @if(isset($stat['change']))
                <p class="text-sm {{ $stat['change'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                    <i class="fas fa-arrow-{{ $stat['change'] > 0 ? 'up' : 'down' }}"></i>
                    {{ abs($stat['change']) }}%
                </p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif