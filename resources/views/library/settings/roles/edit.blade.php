@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <span>Edit Role {{$role->name}}</span>
@endsection

@section('content')
<div class="container-fluid py-4">
    {{-- <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Role: {{ $role->name }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('settings.roles') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('settings.roles.update', $role) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><strong>Assign Permissions</strong></label>
                            <div class="border rounded p-3" style="max-height: 500px; overflow-y: auto;">
                                @foreach($permissions as $module => $perms)
                                <div class="mb-3">
                                    <h6 class="text-primary border-bottom pb-2 mb-2">
                                        {{ ucfirst($module) }}
                                        <button type="button" class="btn btn-sm btn-link float-end select-all-module" data-module="{{ $module }}">Select All</button>
                                    </h6>
                                    <div class="row">
                                        @foreach($perms as $perm)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-check">
                                                <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" class="form-check-input perm-{{ $module }}" id="perm_{{ $perm->id }}"
                                                    {{ in_array($perm->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
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
                                <i class="bi bi-check-circle me-1"></i>Update Role
                            </button>
                            <a href="{{ route('settings.roles') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.select-all-module').forEach(btn => {
        btn.addEventListener('click', function() {
            const module = this.dataset.module;
            const checkboxes = document.querySelectorAll('.perm-' + module);
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);
        });
    });
</script>
@endpush
@endsection
