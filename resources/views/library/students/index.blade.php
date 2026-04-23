@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <span>Settings</span>
@endsection

@section('content')
<div class="container-fluid py-4">
    {{-- Page Header --}}
    <div class="library-page-header">
        <div class="d-flex justify-content-between align-items-center">
            {{-- <div>
                <h4><i class="bi bi-mortarboard me-2"></i>Students</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </nav>
            </div> --}}
            @can('student.create')
            <a href="{{ route('students.create') }}" class="btn btn-primary my-2">
                <i class="bi bi-plus-circle me-1"></i>Add Student
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

    {{-- Filter --}}
    <div class="filter-card">
        <form method="GET" class="search-filter m-4">
            <div class="form-group mb-2">
                <input type="text" name="search" class="form-control" placeholder="Search students..." value="{{ request('search') }}">
            </div>
            <div class="form-group">
                <select name="department" class="form-select">
                    <option value="">All Departments</option>
                    {{-- @foreach($departments as $dept)
                    <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class=" mt-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Search</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="data-table-card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6><i class="bi bi-table me-2"></i>Student List</h6>
            {{-- <span class="badge bg-primary">{{ $students->total() }} students</span> --}}
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Info</th>
                        <th>Department</th>
                        <th>Session</th>
                        <th>Books Issued</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                        <td>
                            <div class="member-card">
                                <div class="member-avatar">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                                <div class="member-info">
                                    <h6>{{ $student->name }}</h6>
                                    <small>{{ $student->student_id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $student->department ?? '-' }}</td>
                        <td>{{ $student->session ?? '-' }}</td>
                        <td><span class="badge bg-info">{{ $student->issues_count ?? 0 }}</span></td>
                        <td>
                            @if($student->is_active)
                            <span class="status-badge active">Active</span>
                            @else
                            <span class="status-badge inactive">Inactive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                @can('student.view')
                                <a href="{{ route('students.show', $student) }}" class="btn-action btn-view" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @endcan
                                @can('student.edit')
                                <a href="{{ route('students.edit', $student) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @endcan
                                @can('student.delete')
                                <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Delete this student?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="bi bi-mortarboard"></i>
                                <h5>No Students Found</h5>
                                <p>Start by adding a new student.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody> --}}
            </table>
        </div>
        {{-- @if($students->hasPages())
        <div class="p-3 border-top">
            {{ $students->links() }}
        </div>
        @endif --}}
    </div>
</div>
@endsection
