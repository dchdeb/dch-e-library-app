@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <span>Role Management</span>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            {{-- <div>
                <h4 class="mb-0"><i class="bi bi-person-badge me-2"></i>Role Management</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </nav>
            </div> --}}
            @can('settings.roles.manage')
            <a href="{{ route('settings.roles.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Create Role
            </a>
            @endcan
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Users</th>
                            <th>Permissions</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-primary fs-6">{{ $role->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $role->users_count }} users</span>
                            </td>
                            <td>
                                @php $permCount = $role->permissions->count(); @endphp
                                <span class="badge bg-info">{{ $permCount }} permissions</span>
                                @if($permCount > 0 && $permCount <= 5)
                                <br><small class="text-muted">
                                    {{ $role->permissions->pluck('name')->map(function($p) { return explode('.', $p)[0]; })->unique()->take(5)->join(', ') }}
                                </small>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('settings.roles.edit', $role) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if(!in_array($role->name, ['Admin', 'Librarian', 'Doctor', 'Student']))
                                    <form action="{{ route('settings.roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No roles found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $roles->links() }}
        </div>
    </div>
</div>
@endsection
