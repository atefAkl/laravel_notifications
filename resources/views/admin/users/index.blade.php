@extends('admin.layouts.app')

@section('title', __('Users'))

@section('content')
<!-- Breadcrumbs -->
<div class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">{{ __('Home') }}</a>
    <span>/</span>
    <span class="text-gray-900">{{ __('Users') }}</span>
</div>

<!-- Page Header -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Users') }}</h1>
        <p class="text-sm text-gray-600">{{ __('Users and their permissions.') }}</p>
    </div>

    <div class="flex space-x-3">
        <a href="{{ route('admin.users.create') }}" class="btn-primary-custom">
            <i class="fas fa-plus mr-2"></i>{{ __('Add New User') }}
        </a>
    </div>
</div>

<!-- Filter Section -->
<div class="card-custom p-6 mb-6">
    <form method="GET" action="{{ request()->url() }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Name') }}
                </label>
                <input type="text"
                    name="search"
                    value="{{ request()->get('search') }}"
                    placeholder="{{ __('or email...') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Type') }}
                </label>
                <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">{{ __('All') }}</option>
                    <option value="admin">{{ __('Admin') }}</option>
                    <option value="user">{{ __('User') }}</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Status') }}
                </label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">{{ __('All') }}</option>
                    <option value="active">{{ __('Active') }}</option>
                    <option value="inactive">{{ __('Inactive') }}</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Product') }}
                </label>
                <select name="product" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">{{ __('All') }}</option>
                    <option value="1">Product 1</option>
                    <option value="2">Product 2</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('From Date') }}
                </label>
                <input type="date"
                    name="created_from"
                    value="{{ request()->get('created_from') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('To Date') }}
                </label>
                <input type="date"
                    name="created_to"
                    value="{{ request()->get('created_to') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="flex justify-between items-center">
            <div class="flex space-x-3">
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-filter mr-2"></i>{{ __('Filter') }}
                </button>
                <a href="{{ request()->url() }}" class="btn-secondary-custom">
                    <i class="fas fa-times mr-2"></i>{{ __('Clear') }}
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Users Table -->
<div class="card-custom p-6">
    @if (session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('ID') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('NAME') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('EMAIL') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('ROLES') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('CREATED AT') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('ACTIONS') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $user->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->roles->count() > 0)
                        @foreach($user->roles as $role)
                        <span class="badge-offer">{{ $role->name }}</span>
                        @endforeach
                        @else
                        <span class="text-gray-500">{{ __('No roles') }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $user->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button class="action-btn-show" onclick="window.location.href='{{ route('admin.users.show', $user) }}'">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn-edit" onclick="window.location.href='{{ route('admin.users.edit', $user) }}'">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn-delete" onclick="if(confirm('{{ __('Are you sure?') }}')) { window.location.href='{{ route('admin.users.destroy', $user) }}' }">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        {{ __('No users found.') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $users->links() }}
    </div>
    @endif
</div>

<!-- Quick Actions Footer -->
<div class="card-custom p-4 mt-6">
    <div class="flex justify-between items-center">
        <h4 class="text-sm font-medium text-gray-900">{{ __('Quick Actions') }}</h4>
        <div class="flex space-x-3">
            <a href="{{ route('admin.users.create') }}" class="btn-primary-custom">
                <i class="fas fa-user-plus mr-2"></i>{{ __('New User') }}
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn-primary-custom">
                <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
            </a>
            <button onclick="window.print()" class="btn-secondary-custom">
                <i class="fas fa-print mr-2"></i>{{ __('Print') }}
            </button>
        </div>
    </div>
</div>
@endsection