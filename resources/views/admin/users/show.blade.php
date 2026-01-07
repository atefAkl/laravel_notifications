@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ __('User Details') }}: {{ $user->name }}</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><strong>{{ __('ID') }}:</strong></div>
                        <div class="col-md-9">{{ $user->id }}</div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3"><strong>{{ __('Name') }}:</strong></div>
                        <div class="col-md-9">{{ $user->name }}</div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3"><strong>{{ __('Email') }}:</strong></div>
                        <div class="col-md-9">{{ $user->email }}</div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3"><strong>{{ __('Roles') }}:</strong></div>
                        <div class="col-md-9">
                            {{ $user->roles->pluck('name')->implode(', ') ?: 'No roles assigned' }}
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3"><strong>{{ __('Email Verified') }}:</strong></div>
                        <div class="col-md-9">
                            {{ $user->email_verified_at ? 'Yes (' . $user->email_verified_at->format('Y-m-d H:i') . ')' : 'No' }}
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3"><strong>{{ __('Created At') }}:</strong></div>
                        <div class="col-md-9">{{ $user->created_at->format('Y-m-d H:i') }}</div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3"><strong>{{ __('Updated At') }}:</strong></div>
                        <div class="col-md-9">{{ $user->updated_at->format('Y-m-d H:i') }}</div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                                {{ __('Edit User') }}
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                {{ __('Back to Users') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection