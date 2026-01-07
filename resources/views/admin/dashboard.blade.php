@extends('admin.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<!-- Breadcrumbs -->
@include('admin.components.breadcrumbs', ['breadcrumbs' => [
['title' => __('Dashboard')]
]])

<!-- Page Header -->
@include('admin.components.page-header', [
'title' => __('Dashboard'),
'subtitle' => __('Welcome back! Here\'s what\'s happening with your users today.'),
'actions' => [
[
'type' => 'link',
'title' => __('Add User'),
'url' => route('admin.users.create'),
'icon' => 'fas fa-plus',
'color' => 'green'
],
[
'type' => 'dropdown',
'title' => __('Export'),
'icon' => 'fas fa-download',
'color' => 'blue',
'id' => 'exportDropdown',
'items' => [
['type' => 'link', 'title' => __('Export as PDF'), 'url' => '#', 'icon' => 'fas fa-file-pdf'],
['type' => 'link', 'title' => __('Export as Excel'), 'url' => '#', 'icon' => 'fas fa-file-excel'],
['type' => 'link', 'title' => __('Export as CSV'), 'url' => '#', 'icon' => 'fas fa-file-csv'],
]
]
]
])

<!-- Statistics Cards -->
@include('admin.components.stats-cards', ['stats' => [
[
'label' => __('Total Users'),
'value' => $stats['total_users'],
'icon' => 'fas fa-users',
'color' => 'blue',
'change' => 12
],
[
'label' => __('New Users Today'),
'value' => $stats['new_users_today'],
'icon' => 'fas fa-user-plus',
'color' => 'green',
'change' => 8
],
[
'label' => __('Active Users'),
'value' => $stats['active_users'],
'icon' => 'fas fa-user-check',
'color' => 'purple',
'change' => -2
],
[
'label' => __('Admin Users'),
'value' => $stats['admin_users'],
'icon' => 'fas fa-user-shield',
'color' => 'red',
'change' => 0
]
]])

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Users -->
    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">{{ __('Recent Users') }}</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentUsers as $user)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-medium">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $user->roles->pluck('name')->implode(', ') ?: 'User' }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500">{{ __('No recent users found.') }}</p>
                @endforelse
            </div>
            @if($recentUsers->count() > 0)
            <div class="mt-4 text-center">
                <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    {{ __('View all users') }} →
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- User Registration Chart -->
    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">{{ __('User Registrations (Last 7 Days)') }}</h3>
        </div>
        <div class="p-6">
            @if($userRegistrations->count() > 0)
            <div class="space-y-3">
                @foreach($userRegistrations as $registration)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span class="ml-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($registration->date)->format('M j, Y') }}</span>
                    </div>
                    <span class="text-sm font-medium text-gray-900">{{ $registration->count }} {{ __('users') }}</span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-center text-gray-500">{{ __('No user registrations in the last 7 days.') }}</p>
            @endif
        </div>
    </div>
</div>

<!-- Quick Actions Footer -->
<div class="mt-6 bg-white rounded-lg shadow p-4 border border-gray-200">
    <div class="flex justify-between items-center">
        <h4 class="text-sm font-medium text-gray-900">{{ __('Quick Actions') }}</h4>
        <div class="flex space-x-3">
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-user-plus mr-2"></i>{{ __('New User') }}
            </a>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-users mr-2"></i>{{ __('Manage Users') }}
            </a>
            <button onclick="window.print()" class="inline-flex items-center px-3 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-print mr-2"></i>{{ __('Print Report') }}
            </button>
        </div>
    </div>
</div>
@endsection