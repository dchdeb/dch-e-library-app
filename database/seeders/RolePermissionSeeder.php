<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\{Permission, Role};

class RolePermissionSeeder extends Seeder
{
    /**
     * E-Library Management System - Complete Role & Permission Setup
     *
     * Modules:
     * 1. Category
     * 2. Author
     * 3. Location Rack
     * 4. Book
     * 5. Student
     * 6. Doctor
     * 7. Issue Book
     * 8. Daily Report
     * 9. Book Inventory
     * 10. Punishment
     * 11. Settings
     */
    public function run(): void
    {
        // Clear permission cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ============================================
        // ১. সব MODULES ডিফাইন করুন
        // ============================================

        $modules = [
            'category' => 'Category',
            'author' => 'Author',
            'rack' => 'Location Rack',
            'book' => 'Book',
            'student' => 'Student',
            'doctor' => 'Doctor',
            'issue-book' => 'Issue Book',
            'daily-report' => 'Daily Report',
            'book-inventory' => 'Book Inventory',
            'punishment' => 'Punishment',
            'settings' => 'Settings',
        ];

        // ============================================
        // ২. PERMISSION ACTIONS ডিফাইন করুন
        // ============================================

        $actions = ['view', 'create', 'edit', 'delete', 'print', 'export'];

        // ============================================
        // ৩. সব PERMISSIONS তৈরি করুন
        // ============================================

        $allPermissions = [];

        foreach ($modules as $moduleName => $displayName) {
            foreach ($actions as $action) {
                $permissionName = "{$moduleName}.{$action}";

                $permission = Permission::firstOrCreate(
                    ['name' => $permissionName, 'guard_name' => 'web']
                );

                $allPermissions[$moduleName][] = $permissionName;
            }
        }

        // Settings এর Special Permissions
        $specialPermissions = [
            'settings.users.manage',
            'settings.roles.manage',
            'settings.permissions.manage',
            'settings.system.configure',
        ];

        foreach ($specialPermissions as $permName) {
            Permission::firstOrCreate(
                ['name' => $permName, 'guard_name' => 'web']
            );
            $allPermissions['settings'][] = $permName;
        }

        // ============================================
        // ৪. ROLES তৈরি করুন
        // ============================================

        // Admin - সব permission পাবে
        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->givePermissionTo(Permission::all());

        // Librarian - Settings ছাড়া সব পাবে
        $librarian = Role::firstOrCreate(['name' => 'Librarian', 'guard_name' => 'web']);
        $librarianPermissions = array_merge(
            $allPermissions['category'] ?? [],
            $allPermissions['author'] ?? [],
            $allPermissions['rack'] ?? [],
            $allPermissions['book'] ?? [],
            $allPermissions['student'] ?? [],
            $allPermissions['doctor'] ?? [],
            $allPermissions['issue-book'] ?? [],
            $allPermissions['daily-report'] ?? [],
            $allPermissions['book-inventory'] ?? [],
            $allPermissions['punishment'] ?? [],
            ['settings.view']
        );
        $librarian->givePermissionTo($librarianPermissions);

        // Doctor - বই দেখা ও Issue করা
        $doctor = Role::firstOrCreate(['name' => 'Doctor', 'guard_name' => 'web']);
        $doctorPermissions = [
            'category.view',
            'author.view',
            'book.view',
            'issue-book.view',
            'issue-book.create',
            'daily-report.view',
        ];
        $doctor->givePermissionTo($doctorPermissions);

        // Student - শুধু বই দেখা
        $student = Role::firstOrCreate(['name' => 'Student', 'guard_name' => 'web']);
        $studentPermissions = [
            'book.view',
            'issue-book.view',
        ];
        $student->givePermissionTo($studentPermissions);

        // Clear cache again
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ============================================
        // ৫. DEFAULT USERS তৈরি করুন              
        // ============================================

        // Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@library.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('susmi123'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('Admin');

        // Demo Librarian
        $librarianUser = User::firstOrCreate(
            ['email' => 'librarian@library.com'],
            [
                'name' => 'Demo Librarian',
                'password' => bcrypt('librarian987'),
                'email_verified_at' => now(),
            ]
        );
        $librarianUser->assignRole('Librarian');

        // Demo Doctor
        $doctorUser = User::firstOrCreate(
            ['email' => 'doctor@library.com'],
            [
                'name' => 'Demo Doctor',
                'password' => bcrypt('doctor2345'),
                'email_verified_at' => now(),
            ]
        );
        $doctorUser->assignRole('Doctor');

        // Demo Student
        $studentUser = User::firstOrCreate(
            ['email' => 'student@library.com'],
            [
                'name' => 'Demo Student',
                'password' => bcrypt('student456'),
                'email_verified_at' => now(),
            ]
        );
        $studentUser->assignRole('Student');

        // ============================================
        // ৬. OUTPUT MESSAGE
        // ============================================

        $this->command->info('');
        $this->command->info('✅ E-Library Role Permission Seeder completed successfully!');
        $this->command->info('');
        $this->command->info('📋 Created Roles:');
        $this->command->info('   1. Admin - Full Access');
        $this->command->info('   2. Librarian - Library Management');
        $this->command->info('   3. Doctor - Book Access');
        $this->command->info('   4. Student - Limited Access');
        $this->command->info('');
        $this->command->info('📚 Modules:');
        $this->command->info('   1. Category');
        $this->command->info('   2. Author');
        $this->command->info('   3. Location Rack');
        $this->command->info('   4. Book');
        $this->command->info('   5. Student');
        $this->command->info('   6. Doctor');
        $this->command->info('   7. Issue Book');
        $this->command->info('   8. Daily Report');
        $this->command->info('   9. Book Inventory');
        $this->command->info('   10. Punishment');
        $this->command->info('   11. Settings');
        $this->command->info('');
        $this->command->info('🔐 Total Permissions: ' . Permission::count());
        $this->command->info('👥 Total Roles: ' . Role::count());
        $this->command->info('');
        $this->command->info('👤 Default Users:');
        $this->command->info('   Admin: admin@library.com / susmi123');
        $this->command->info('   Librarian: librarian@library.com / librarian987');
        $this->command->info('   Doctor: doctor@library.com / doctor2345');
        $this->command->info('   Student: student@library.com / student456');
    }
}
