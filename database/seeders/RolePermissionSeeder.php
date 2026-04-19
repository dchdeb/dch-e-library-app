<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\{Permission, Role};

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ১. পারমিশন তৈরি
        $permissions = [
            'view dashboard',
            'manage settings', // শুধু Admin এর জন্য
            
            'manage book',
            'manage student',
            'manage doctor',   // ডাক্তার একটি মডিউল হিসেবে থাকবে, কিন্তু রোল হিসেবে না
            'issue book',
            'return book'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // ২. রোল তৈরি (শুধু Admin এবং Librarian)
        $adminRole = Role::create(['name' => 'admin']);
        $librarianRole = Role::create(['name' => 'librarian']);

        // ৩. পারমিশন অ্যাসাইন
        // Admin সব পারমিশন পাবে
        $adminRole->givePermissionTo(Permission::all());

        // Librarian নির্দিষ্ট পারমিশন পাবে (Settings পাবে না)
        $librarianRole->givePermissionTo([
            'view dashboard',
            'manage book',
            'manage student',
            'manage doctor',
            'issue book',
            'return book'
        ]);

        // ৪. ডিফল্ট Super Admin তৈরি
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'susmita@gmail.com',
            'password' => bcrypt('susmi123')
        ]);
        $user->assignRole('admin');

        // ডেমো Librarian তৈরি (ঐচ্ছিক)
        $librarian = User::create([
            'name' => 'Librarian',
            'email' => 'librarian@gmail.com',
            'password' => bcrypt('1234susmi')
        ]);
        $librarian->assignRole('librarian');
    }
}