<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Library\{AuthorController, BookController, BookInventoryController, CategoryController, DailyReportController, DoctorController, IssueBookController, PunishmentController, RackController, SettingsController, StudentController};

// Root redirect
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== LIBRARY MODULES ====================

Route::middleware(['auth', 'verified'])->group(function () {

    // ========== CATEGORIES ==========
    Route::middleware('permission:category.view')->group(function () {
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    });
    Route::middleware('permission:category.create')->group(function () {
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    });
    Route::middleware('permission:category.edit')->group(function () {
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    });
    Route::middleware('permission:category.delete')->group(function () {
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // ========== AUTHORS ==========
    Route::middleware('permission:author.view')->group(function () {
        Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
        Route::get('authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
    });
    Route::middleware('permission:author.create')->group(function () {
        Route::get('authors/create', [AuthorController::class, 'create'])->name('authors.create');
        Route::post('authors', [AuthorController::class, 'store'])->name('authors.store');
    });
    Route::middleware('permission:author.edit')->group(function () {
        Route::get('authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
        Route::put('authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
    });
    Route::middleware('permission:author.delete')->group(function () {
        Route::delete('authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
    });

    // ========== RACKS (Location Rack) ==========
    Route::middleware('permission:rack.view')->group(function () {
        Route::get('racks', [RackController::class, 'index'])->name('racks.index');
        Route::get('racks/{rack}', [RackController::class, 'show'])->name('racks.show');
    });
    Route::middleware('permission:rack.create')->group(function () {
        Route::get('racks/create', [RackController::class, 'create'])->name('racks.create');
        Route::post('racks', [RackController::class, 'store'])->name('racks.store');
    });
    Route::middleware('permission:rack.edit')->group(function () {
        Route::get('racks/{rack}/edit', [RackController::class, 'edit'])->name('racks.edit');
        Route::put('racks/{rack}', [RackController::class, 'update'])->name('racks.update');
    });
    Route::middleware('permission:rack.delete')->group(function () {
        Route::delete('racks/{rack}', [RackController::class, 'destroy'])->name('racks.destroy');
    });

    // ========== BOOKS ==========
    Route::middleware('permission:book.view')->group(function () {
        Route::get('books', [BookController::class, 'index'])->name('books.index');
        Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
    });
    Route::middleware('permission:book.create')->group(function () {
        Route::get('books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('books', [BookController::class, 'store'])->name('books.store');
    });
    Route::middleware('permission:book.edit')->group(function () {
        Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');
    });
    Route::middleware('permission:book.delete')->group(function () {
        Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    });

    // ========== STUDENTS ==========
    Route::middleware('permission:student.view')->group(function () {
        Route::get('students', [StudentController::class, 'index'])->name('students.index');
        Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');
    });
    Route::middleware('permission:student.create')->group(function () {
        Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('students', [StudentController::class, 'store'])->name('students.store');
    });
    Route::middleware('permission:student.edit')->group(function () {
        Route::get('students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update');
    });
    Route::middleware('permission:student.delete')->group(function () {
        Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    // ========== DOCTORS ==========
    Route::middleware('permission:doctor.view')->group(function () {
        Route::get('doctors', [DoctorController::class, 'index'])->name('doctors.index');
        Route::get('doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
    });
    Route::middleware('permission:doctor.create')->group(function () {
        Route::get('doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
        Route::post('doctors', [DoctorController::class, 'store'])->name('doctors.store');
    });
    Route::middleware('permission:doctor.edit')->group(function () {
        Route::get('doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
        Route::put('doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
    });
    Route::middleware('permission:doctor.delete')->group(function () {
        Route::delete('doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    });

    // ========== ISSUE BOOKS ==========
    Route::middleware('permission:issue-book.view')->group(function () {
        Route::get('issue-books', [IssueBookController::class, 'index'])->name('issue-books.index');
        Route::get('issue-books/{issueBook}', [IssueBookController::class, 'show'])->name('issue-books.show');
        Route::get('issue-books/overdue', [IssueBookController::class, 'overdue'])->name('issue-books.overdue');
    });
    Route::middleware('permission:issue-book.create')->group(function () {
        Route::get('issue-books/create', [IssueBookController::class, 'create'])->name('issue-books.create');
        Route::post('issue-books', [IssueBookController::class, 'store'])->name('issue-books.store');
        Route::get('issue-books/{issueBook}/return', [IssueBookController::class, 'returnBook'])->name('issue-books.return');
        Route::post('issue-books/{issueBook}/return', [IssueBookController::class, 'processReturn'])->name('issue-books.process-return');
    });
    Route::middleware('permission:issue-book.edit')->group(function () {
        Route::get('issue-books/{issueBook}/edit', [IssueBookController::class, 'edit'])->name('issue-books.edit');
        Route::put('issue-books/{issueBook}', [IssueBookController::class, 'update'])->name('issue-books.update');
    });
    Route::middleware('permission:issue-book.delete')->group(function () {
        Route::delete('issue-books/{issueBook}', [IssueBookController::class, 'destroy'])->name('issue-books.destroy');
    });

    // ========== DAILY REPORTS ==========
    Route::middleware('permission:daily-report.view')->group(function () {
        Route::get('daily-reports', [DailyReportController::class, 'index'])->name('daily-reports.index');
        Route::get('daily-reports/{dailyReport}', [DailyReportController::class, 'show'])->name('daily-reports.show');
    });
    Route::middleware('permission:daily-report.create')->group(function () {
        Route::get('daily-reports/create', [DailyReportController::class, 'create'])->name('daily-reports.create');
        Route::post('daily-reports', [DailyReportController::class, 'store'])->name('daily-reports.store');
        Route::get('daily-reports/generate-today', [DailyReportController::class, 'generateToday'])->name('daily-reports.generate-today');
    });
    Route::middleware('permission:daily-report.print')->group(function () {
        Route::get('daily-reports/{dailyReport}/print', [DailyReportController::class, 'print'])->name('daily-reports.print');
    });
    Route::middleware('permission:daily-report.export')->group(function () {
        Route::get('daily-reports/export', [DailyReportController::class, 'export'])->name('daily-reports.export');
    });

    // ========== BOOK INVENTORY ==========
    Route::middleware('permission:book-inventory.view')->group(function () {
        Route::get('book-inventories', [BookInventoryController::class, 'index'])->name('book-inventories.index');
        Route::get('book-inventories/{bookInventory}', [BookInventoryController::class, 'show'])->name('book-inventories.show');
        Route::get('book-inventories/report', [BookInventoryController::class, 'report'])->name('book-inventories.report');
    });
    Route::middleware('permission:book-inventory.create')->group(function () {
        Route::get('book-inventories/create', [BookInventoryController::class, 'create'])->name('book-inventories.create');
        Route::post('book-inventories', [BookInventoryController::class, 'store'])->name('book-inventories.store');
    });
    Route::middleware('permission:book-inventory.export')->group(function () {
        Route::get('book-inventories/export', [BookInventoryController::class, 'export'])->name('book-inventories.export');
    });

    // ========== PUNISHMENTS ==========
    Route::middleware('permission:punishment.view')->group(function () {
        Route::get('punishments', [PunishmentController::class, 'index'])->name('punishments.index');
        Route::get('punishments/{punishment}', [PunishmentController::class, 'show'])->name('punishments.show');
    });
    Route::middleware('permission:punishment.create')->group(function () {
        Route::get('punishments/create', [PunishmentController::class, 'create'])->name('punishments.create');
        Route::post('punishments', [PunishmentController::class, 'store'])->name('punishments.store');
        Route::get('punishments/{punishment}/payment', [PunishmentController::class, 'payment'])->name('punishments.payment');
        Route::post('punishments/{punishment}/payment', [PunishmentController::class, 'processPayment'])->name('punishments.process-payment');
        Route::post('punishments/{punishment}/waive', [PunishmentController::class, 'waive'])->name('punishments.waive');
    });
    Route::middleware('permission:punishment.edit')->group(function () {
        Route::get('punishments/{punishment}/edit', [PunishmentController::class, 'edit'])->name('punishments.edit');
        Route::put('punishments/{punishment}', [PunishmentController::class, 'update'])->name('punishments.update');
    });
    Route::middleware('permission:punishment.delete')->group(function () {
        Route::delete('punishments/{punishment}', [PunishmentController::class, 'destroy'])->name('punishments.destroy');
    });

    // ========== SETTINGS ==========
    Route::middleware('permission:settings.view')->group(function () {
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    });

    // Users Management
    Route::middleware('permission:settings.users.manage')->group(function () {
        Route::get('settings/users', [SettingsController::class, 'users'])->name('settings.users');
        Route::get('settings/users/create', [SettingsController::class, 'createUser'])->name('settings.users.create');
        Route::post('settings/users', [SettingsController::class, 'storeUser'])->name('settings.users.store');
        Route::get('settings/users/{user}/edit', [SettingsController::class, 'editUser'])->name('settings.users.edit');
        Route::put('settings/users/{user}', [SettingsController::class, 'updateUser'])->name('settings.users.update');
        Route::delete('settings/users/{user}', [SettingsController::class, 'destroyUser'])->name('settings.users.destroy');
    });

    // Roles Management
    Route::middleware('permission:settings.roles.manage')->group(function () {
        Route::get('settings/roles', [SettingsController::class, 'roles'])->name('settings.roles');
        Route::get('settings/roles/create', [SettingsController::class, 'createRole'])->name('settings.roles.create');
        Route::post('settings/roles', [SettingsController::class, 'storeRole'])->name('settings.roles.store');
        Route::get('settings/roles/{role}/edit', [SettingsController::class, 'editRole'])->name('settings.roles.edit');
        Route::put('settings/roles/{role}', [SettingsController::class, 'updateRole'])->name('settings.roles.update');
        Route::delete('settings/roles/{role}', [SettingsController::class, 'destroyRole'])->name('settings.roles.destroy');
    });

    // Permissions View
    Route::middleware('permission:settings.permissions.manage')->group(function () {
        Route::get('settings/permissions', [SettingsController::class, 'permissions'])->name('settings.permissions');
    });
});

require __DIR__.'/auth.php';
