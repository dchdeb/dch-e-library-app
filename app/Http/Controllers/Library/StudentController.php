<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // $query = Student::withCount(['issues' => function ($q) {
        //     $q->where('status', 'issued');
        // }]);

        // if ($request->filled('search')) {
        //     $search = $request->search;
        //     $query->where(function ($q) use ($search) {
        //         $q->where('name', 'like', "%{$search}%")
        //             ->orWhere('student_id', 'like', "%{$search}%")
        //             ->orWhere('email', 'like', "%{$search}%")
        //             ->orWhere('phone', 'like', "%{$search}%");
        //     });
        // }

        // if ($request->filled('department')) {
        //     $query->where('department', $request->department);
        // }

        // if ($request->filled('status')) {
        //     $query->where('is_active', $request->status === 'active');
        // }

        // $students = $query->orderBy('name')->paginate(15);
        // $departments = Student::distinct()->pluck('department')->filter()->sort();

        // return view('library.students.index', compact('students', 'departments'));


        return view('library.students.index');
    }

    public function create()
    {
        return view('library.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'department' => 'nullable|string|max:100',
            'session' => 'nullable|string|max:50',
            'membership_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:membership_date',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully!');
    }

    public function show(Student $student)
    {
        $student->load(['issues.book']);
        return view('library.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('library.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'department' => 'nullable|string|max:100',
            'session' => 'nullable|string|max:50',
            'membership_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:membership_date',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        if ($student->issues()->where('status', 'issued')->count() > 0) {
            return back()->with('error', 'Cannot delete student with active book issues!');
        }

        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
