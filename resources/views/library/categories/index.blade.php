@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <span>Book Management</span>
    <span>(Category)</span>
@endsection

@section('content')
    <div class="container-fluid py-4">
        {{-- Page Header --}}
        <div class="library-page-header">
            <div class="d-flex justify-content-between align-items-center">
                {{-- <div>
                <h4><i class="bi bi-tags me-2"></i>Categories</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </nav>
            </div> --}}
                @can('category.create')
                    <a href="{{ route('categories.create') }}" class="btn btn-outline-primary mb-1">
                        <i class="bi bi-plus-circle me-2"></i>Add Category
                    </a>

                    {{-- <a href="{{ route('books.create') }}" class="btn btn-outline-primary">
                     <i class="bi bi-plus-circle me-2"></i>Add New Book
              </a> --}}
                @endcan
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Filter Card --}}
        <div class="filter-card m-2">
            <form method="GET" class="search-filter p-4">
                <div class="form-group">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Search categories..."
                        value="{{ request('search') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="m-2">
                    <button type="submit" class="btn btn-primary btn-search">
                        <i class="bi bi-search me-1"></i>Search
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Reset</a>
                </div>

            </form>
        </div>

        {{-- Data Table --}}
        <div class="data-table-card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6><i class="bi bi-table me-2"></i>Category List</h6>
                {{-- <span class="badge bg-primary">{{ $categories->total() }} records</span> --}}
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            {{-- <th>Books</th> --}}
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                {{-- <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td> --}}

                                <td>{{ $category->id }}</td>
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                </td>
                                <td><code>{{ $category->slug }}</code></td>
                                {{-- <td>
                            <span class="badge bg-info">{{ $category->books_count ?? 0 }} books</span>
                        </td> --}}
                                <td>
                                    @if ($category->is_active)
                                        <span class="status-badge active">Active</span>
                                    @else
                                        <span class="status-badge inactive">Inactive</span>
                                    @endif
                                </td>


                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        {{-- @can('category.view')
                                            <a href="{{ route('categories.show', $category) }}" class="btn-action btn-view"
                                                title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        @endcan     Biochemistry  Physiology  Anatomy   Pathology  Microbiolog   Large and airconditioned reading area for the students.     --}}
                                        @can('category.edit')
                                            <a href="{{ route('categories.edit', $category) }}"  class="btn btn-outline-primary mx-1"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('category.delete')
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                                onsubmit="return confirm('Delete this category?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-tags"></i>
                                        <h5>No Categories Found</h5>
                                        <p>Start by adding a new category.</p>
                                        @can('category.create')
                                            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                                <i class="bi bi-plus-circle me-1"></i>Add Category
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- @if ($categories->hasPages())
                <div class="p-3 border-top">
                    {{ $categories->links() }}
                </div>
            @endif --}}
        </div>
    </div>
@endsection
