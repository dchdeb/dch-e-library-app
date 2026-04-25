@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <span>Create Role</span>
@endsection

@section('content')
<div class="container-fluid py-4">
    {{-- <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>Create Role</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('settings.roles') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div> --}}
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="mb-0"><i class="bi bi-person-fill me-2"></i>Create Role</h4>
            <nav aria-label="breadcumb">
                <ol class=" breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('settings.index')}}">Settings </a></li>
                    <li class="breadcrumb-item active">Create</li>

                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('settings.roles.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><strong>Assign Permissions</strong></label>
                            <div class="border rounded p-3">
                                @foreach($permissions as $module => $perms)
                                <div class="mb-3">
                                    <h6 class="text-primary border-bottom pb-2 mb-2">{{ ucfirst($module) }}</h6>
                                    <div class="row">
                                        @foreach($perms as $perm)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-check">
                                                <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" class="form-check-input" id="perm_{{ $perm->id }}"
                                                    {{ in_array($perm->name, old('permissions', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm_{{ $perm->id }}">{{ $perm->name }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i>Create Role
                            </button>
                            <a href="{{ route('settings.roles') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
