@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <span>Settings</span>
@endsection

{{-- @section('title', 'Settings') --}}

@section('content')
<div class="container-fluid py-4">
 

    <div class="row g-4">
        {{-- Statistics Cards --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-book text-primary fs-1"></i>
                    {{-- <h3 class="mt-2 mb-0">{{ $stats['total_books'] }}</h3> --}}
                    <small class="text-muted">Total Books</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-mortarboard text-success fs-1"></i>
                    {{-- <h3 class="mt-2 mb-0">{{ $stats['total_students'] }}</h3> --}}
                    <small class="text-muted">Students</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-clipboard2-pulse text-info fs-1"></i>
                    {{-- <h3 class="mt-2 mb-0">{{ $stats['total_doctors'] }}</h3> --}}
                    <small class="text-muted">Doctors</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-arrow-left-right text-warning fs-1"></i>
                    {{-- <h3 class="mt-2 mb-0">{{ $stats['total_issued'] }}</h3> --}}
                    <small class="text-muted">Books Issued</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Quick Links --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @can('book.create')
                        <a href="{{ route('books.create') }}" class="btn btn-outline-primary">
                            <i class="bi bi-plus-circle me-2"></i>Add New Book
                        </a>
                        @endcan
                        @can('issue-book.create')
                        <a href="{{ route('issue-books.create') }}" class="btn btn-outline-success">
                            <i class="bi bi-arrow-right-circle me-2"></i>Issue Book
                        </a>
                        @endcan
                        @can('student.create')
                        <a href="{{ route('students.create') }}" class="btn btn-outline-info">
                            <i class="bi bi-person-plus me-2"></i>Add Student
                        </a>
                        @endcan
                        @can('doctor.create')
                        <a href="{{ route('doctors.create') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-person-plus me-2"></i>Add Doctor
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        {{-- Management Links --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="bi bi-sliders me-2"></i>Management</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @can('settings.users.manage')
                        <a href="{{ route('settings.users') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-people me-2"></i>User Management</span>
                            <span class="badge bg-primary rounded-pill">{{ $stats['total_users'] }}</span>
                        </a>
                        @endcan
                        @can('settings.roles.manage')
                        <a href="{{ route('settings.roles') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-person-badge me-2"></i>Role Management
                        </a>
                        @endcan
                        @can('settings.permissions.manage')
                        <a href="{{ route('settings.permissions') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-key me-2"></i>Permissions
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>


        {{-- Student management --}}
        {{-- <div class="col-md-6">
            <div class=" card border-0 shadow-sm">
                <div class=" card-header bg-white">
                    <h6 class="mb-0"><i class=" bi bi-sliders me-4"> Students Management Create for remove</i></h6>
                </div>
                <div class=" card-body">
                    <div class="list-group list-group-flash">
                        @can ('settings.student.manage')
                        <a href=" settings.students.roles" class="list-group list-group-flash d-flex justify-items-center align-item-center"></a>
                        <span> </span>

                        @endcan

                    </div>

                </div>

            </div>

        </div> --}}
    </div>
</div>
@endsection
