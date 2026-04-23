<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\{Permission, Role};

class SettingsController extends Controller
{
    public function index()
    {
        $stats = [
            // 'total_books' => \App\Models\Book::count(),
            // 'total_students' => \App\Models\Student::count(),
            // 'total_doctors' => \App\Models\Doctor::count(),
            // 'total_issued' => \App\Models\IssueBook::where('status', 'issued')->count(),
            // 'total_overdue' => \App\Models\IssueBook::overdue()->count(),
            'total_users' => User::count(),
        ];

        return view('library.settings.index', compact('stats'));
    }

    // ==================== USERS ====================

    public function users()
    {
        $users = User::with('roles')->paginate(20);
        return view('library.settings.users.index', compact('users'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('library.settings.users.create', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_verified_at' => now(),
        ]);

        if (!empty($validated['roles'])) {
            $user->assignRole($validated['roles']);
        }

        return redirect()->route('settings.users')
            ->with('success', 'User created successfully!');
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('library.settings.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => bcrypt($validated['password'])]);
        }

        $user->syncRoles($validated['roles'] ?? []);

        return redirect()->route('settings.users')
            ->with('success', 'User updated successfully!');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete yourself!');
        }

        $user->delete();

        return redirect()->route('settings.users')
            ->with('success', 'User deleted successfully!');
    }

    // ==================== ROLES ====================

    public function roles()
    {
        $roles = Role::withCount('users')->with('permissions')->paginate(20);
        return view('library.settings.roles.index', compact('roles'));
    }

    public function createRole()
    {
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[0];
        });
        return view('library.settings.roles.create', compact('permissions'));
    }

    public function storeRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);

        if (!empty($validated['permissions'])) {
            $role->givePermissionTo($validated['permissions']);
        }

        return redirect()->route('settings.roles')
            ->with('success', 'Role created successfully!');
    }

    public function editRole(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[0];
        });
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('library.settings.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updateRole(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('settings.roles')
            ->with('success', 'Role updated successfully!');
    }

    public function destroyRole(Role $role)
    {
        if (in_array($role->name, ['Admin', 'Librarian', 'Doctor', 'Student'])) {
            return back()->with('error', 'Cannot delete system roles!');
        }

        $role->delete();

        return redirect()->route('settings.roles')
            ->with('success', 'Role deleted successfully!');
    }

    // ==================== PERMISSIONS ====================

    public function permissions()
    {
        $permissions = Permission::orderBy('name')->paginate(50);
        $grouped = $permissions->groupBy(function ($perm) {
            return explode('.', $perm->name)[0];
        });
        return view('library.settings.permissions.index', compact('permissions', 'grouped'));
    }
}
