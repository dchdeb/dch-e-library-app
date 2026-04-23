@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <span>Permissions</span>
@endsection

@section('content')
<div class="container-fluid py-4">
    {{-- <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0"><i class="bi bi-key me-2"></i>Permissions</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a></li>
                    <li class="breadcrumb-item active">Permissions</li>
                </ol>
            </nav>
        </div>
    </div> --}}

    <div class="row">
        @foreach($grouped as $module => $perms)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="bi bi-folder me-2"></i>{{ ucfirst($module) }}</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($perms as $perm)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $perm->name }}</span>
                            <span class="badge bg-secondary">{{ explode('.', $perm->name)[1] ?? '' }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body text-center">
            <h5>Total Permissions: <span class="badge bg-primary">{{ $permissions->total() }}</span></h5>
            <p class="text-muted mb-0">Permissions are automatically created by the RolePermissionSeeder.</p>
        </div>
    </div>
</div>
@endsection
