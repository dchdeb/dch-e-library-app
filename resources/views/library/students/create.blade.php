@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <span>Library</span>
    <span>›</span>
    <a href="{{ route('students.index') }}">Students</a>
    <span>›</span>
    <span>Add</span>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="library-page-header">
            <h4><i class="bi bi-plus-circle me-2"></i>Add Student</h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-card ">
                    <div class="card-header pt-5 px-4">
                        <h5 class="mb-0"><i class="bi bi-mortarboard me-2"></i>Student Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="row">

                                <!-- Student ID -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Student ID
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" name="student_id"
                                        class="form-control @error('student_id') is-invalid @enderror"
                                        value="{{ old('student_id') }}" placeholder="DCM-(16)80" required>

                                    @error('student_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Library Card ID -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Library Card ID
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" name="library_card_id"
                                        class="form-control @error('library_card_id') is-invalid @enderror"
                                        value="{{ old('library_card_id') }}" placeholder="191002097" required>

                                    @error('library_card_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Department</label>
                                    <input type="text" name="department" class="form-control"
                                        value="{{ old('department') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Session</label>
                                    <input type="text" name="session" class="form-control" value="{{ old('session') }}"
                                        placeholder="e.g., 2023-2024">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="photo" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Membership Date</label>
                                    <input type="date" name="membership_date" class="form-control"
                                        value="{{ old('membership_date') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="date" name="expiry_date" class="form-control"
                                        value="{{ old('expiry_date') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="isActive"
                                        checked>
                                    <label class="form-check-label" for="isActive">Active</label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary"><i
                                        class="bi bi-check-circle me-1"></i>Save
                                    Student</button>
                                <a href="{{ route('students.index') }}" class="btn btn-secondary"><i
                                        class="bi bi-x-circle me-1"></i>Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
