<style>
    .sidebar-menu {
        padding: 0.5rem;
    }

    /* Nav link styles */
    .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        padding: 0.75rem 1rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
    }

    .sidebar .nav-link.active {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
    }

    .sidebar .nav-ico {
        margin-right: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
    }

    .sidebar-title {
        color: rgb(255, 255, 255);
        font-weight: 500;
    }

    /* Submenu styles */
    .has-submenu {
        position: relative;
    }

    .has-submenu > .nav-link::after {
        content: '\F282';
        font-family: 'bootstrap-icons';
        margin-left: auto;
        transition: transform 0.3s ease;
        font-size: 0.75rem;
    }

    .has-submenu.open > .nav-link::after {
        transform: rotate(180deg);
    }

    .menu-dropdown {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease-out;
        background: rgba(0, 0, 0, 0.15);
        border-radius: 0 0 8px 8px;
        margin-top: -4px;
        margin-bottom: 4px;
    }

    .menu-dropdown.show {
        max-height: 1500px;
        transition: max-height 0.5s ease-in;
    }

    .nav-sublink {
        padding: 0.6rem 1rem 0.6rem 2.5rem !important;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .nav-sublink:hover {
        color: #fff !important;
        background: rgba(255, 255, 255, 0.05) !important;
    }

    .nav-sublink.active {
        color: #fff !important;
        background: rgba(255, 255, 255, 0.1) !important;
    }

    .nav-sublink i {
        font-size: 0.85rem;
    }

    /* Collapsed sidebar */
    .sidebar-collapsed .sidebar {
        width: 65px;
    }

    .sidebar-collapsed .sidebar-title,
    .sidebar-collapsed .menu-dropdown,
    .sidebar-collapsed .has-submenu > .nav-link::after {
        display: none;
    }

    .sidebar-collapsed .nav-link {
        justify-content: center;
        padding: 0.75rem;
    }

    .sidebar-collapsed .nav-ico {
        margin-right: 0;
    }
</style>

@php
    $is = fn($pattern) => request()->routeIs($pattern);
    $active = fn($pattern) => $is($pattern) ? 'active' : '';

    // Submenu open states
    $bookManagementOpen = $is('categories.*') || $is('authors.*') || $is('racks.*') || $is('books.*');
    $membersOpen = $is('students.*') || $is('doctors.*');
    $transactionsOpen = $is('issue-books.*');
    $reportsOpen = $is('daily-reports.*') || $is('book-inventories.*');
    $punishmentOpen = $is('punishments.*');
    $settingsOpen = $is('settings.*');
@endphp

<aside class="sidebar d-none d-lg-flex flex-column" id="sidebar">

    <nav class="nav flex-column gap-1 sidebar-menu">

        {{-- Dashboard --}}
        <a class="nav-link {{ $active('dashboard') }}" href="{{ route('dashboard') }}">
            <span class="nav-ico"><i class="bi bi-speedometer2"></i></span>
            <span class="sidebar-title">Dashboard</span>
        </a>

        {{-- Book Management Section --}}
        @canany(['category.view', 'author.view', 'rack.view', 'book.view'])
        <div class="has-submenu {{ $bookManagementOpen ? 'open' : '' }}">
            <a class="nav-link {{ $bookManagementOpen ? 'active' : '' }}" href="javascript:void(0)" onclick="toggleSubmenu(this)">
                <span class="nav-ico"><i class="bi bi-book"></i></span>
                <span class="sidebar-title">Book Management</span>
            </a>
            <div class="menu-dropdown {{ $bookManagementOpen ? 'show' : '' }}">
                @can('category.view')
                <a class="nav-link nav-sublink {{ $active('categories.*') }}" href="{{ route('categories.index') }}">
                    <i class="bi bi-tags me-2"></i>Category
                </a>
                @endcan
                @can('author.view')
                <a class="nav-link nav-sublink {{ $active('authors.*') }}" href="{{ route('authors.index') }}">
                    <i class="bi bi-person-lines-fill me-2"></i>Author
                </a>
                @endcan
                @can('rack.view')
                <a class="nav-link nav-sublink {{ $active('racks.*') }}" href="{{ route('racks.index') }}">
                    <i class="bi bi-grid-3x3-gap me-2"></i>Location Rack
                </a>
                @endcan
                @can('book.view')
                <a class="nav-link nav-sublink {{ $active('books.*') }}" href="{{ route('books.index') }}">
                    <i class="bi bi-journal-text me-2"></i>Books
                </a>
                @endcan
            </div>
        </div>
        @endcanany

        {{-- Members Section --}}
        @canany(['student.view', 'doctor.view'])
        <div class="has-submenu {{ $membersOpen ? 'open' : '' }}">
            <a class="nav-link {{ $membersOpen ? 'active' : '' }}" href="javascript:void(0)" onclick="toggleSubmenu(this)">
                <span class="nav-ico"><i class="bi bi-people"></i></span>
                <span class="sidebar-title">Members</span>
            </a>
            <div class="menu-dropdown {{ $membersOpen ? 'show' : '' }}">
                @can('student.view')
                <a class="nav-link nav-sublink {{ $active('students.*') }}" href="{{ route('students.index') }}">
                    <i class="bi bi-mortarboard me-2"></i>Students
                </a>
                @endcan
                @can('doctor.view')
                <a class="nav-link nav-sublink {{ $active('doctors.*') }}" href="{{ route('doctors.index') }}">
                    <i class="bi bi-clipboard2-pulse me-2"></i>Doctors
                </a>
                @endcan
            </div>
        </div>
        @endcanany

        {{-- Issue Book --}}
        @canany(['issue-book.view', 'issue-book.create'])
        <div class="has-submenu {{ $transactionsOpen ? 'open' : '' }}">
            <a class="nav-link {{ $transactionsOpen ? 'active' : '' }}" href="javascript:void(0)" onclick="toggleSubmenu(this)">
                <span class="nav-ico"><i class="bi bi-arrow-left-right"></i></span>
                <span class="sidebar-title">Issue Book</span>
            </a>
            <div class="menu-dropdown {{ $transactionsOpen ? 'show' : '' }}">
                @can('issue-book.view')
                <a class="nav-link nav-sublink {{ $active('issue-books.index') }}" href="{{ route('issue-books.index') }}">
                    <i class="bi bi-list-ul me-2"></i>All Issues
                </a>
                <a class="nav-link nav-sublink {{ $active('issue-books.overdue') }}" href="{{ route('issue-books.overdue') }}">
                    <i class="bi bi-exclamation-triangle me-2"></i>Overdue Books
                </a>
                @endcan
                @can('issue-book.create')
                <a class="nav-link nav-sublink {{ $active('issue-books.create') }}" href="{{ route('issue-books.create') }}">
                    <i class="bi bi-plus-circle me-2"></i>New Issue
                </a>
                @endcan
            </div>
        </div>
        @endcanany

        {{-- Reports Section --}}
        @canany(['daily-report.view', 'book-inventory.view'])
        <div class="has-submenu {{ $reportsOpen ? 'open' : '' }}">
            <a class="nav-link {{ $reportsOpen ? 'active' : '' }}" href="javascript:void(0)" onclick="toggleSubmenu(this)">
                <span class="nav-ico"><i class="bi bi-graph-up-arrow"></i></span>
                <span class="sidebar-title">Reports</span>
            </a>
            <div class="menu-dropdown {{ $reportsOpen ? 'show' : '' }}">
                @can('daily-report.view')
                <a class="nav-link nav-sublink {{ $active('daily-reports.*') }}" href="{{ route('daily-reports.index') }}">
                    <i class="bi bi-calendar-day me-2"></i>Daily Report
                </a>
                @endcan
                @can('book-inventory.view')
                <a class="nav-link nav-sublink {{ $active('book-inventories.*') }}" href="{{ route('book-inventories.index') }}">
                    <i class="bi bi-boxes me-2"></i>Book Inventory
                </a>
                @endcan
            </div>
        </div>
        @endcanany

        {{-- Punishment --}}
        @canany(['punishment.view', 'punishment.create'])
        <div class="has-submenu {{ $punishmentOpen ? 'open' : '' }}">
            <a class="nav-link {{ $punishmentOpen ? 'active' : '' }}" href="javascript:void(0)" onclick="toggleSubmenu(this)">
                <span class="nav-ico"><i class="bi bi-exclamation-diamond"></i></span>
                <span class="sidebar-title">Punishment</span>
            </a>
            <div class="menu-dropdown {{ $punishmentOpen ? 'show' : '' }}">
                @can('punishment.view')
                <a class="nav-link nav-sublink {{ $active('punishments.index') }}" href="{{ route('punishments.index') }}">
                    <i class="bi bi-list-ul me-2"></i>All Punishments
                </a>
                @endcan
                @can('punishment.create')
                <a class="nav-link nav-sublink {{ $active('punishments.create') }}" href="{{ route('punishments.create') }}">
                    <i class="bi bi-plus-circle me-2"></i>Add Punishment
                </a>
                @endcan
            </div>
        </div>
        @endcanany

        {{-- Settings --}}
        @canany(['settings.view', 'settings.users.manage', 'settings.roles.manage', 'settings.permissions.manage'])
        <div class="has-submenu {{ $settingsOpen ? 'open' : '' }}">
            <a class="nav-link {{ $settingsOpen ? 'active' : '' }}" href="javascript:void(0)" onclick="toggleSubmenu(this)">
                <span class="nav-ico"><i class="bi bi-gear"></i></span>
                <span class="sidebar-title">Settings</span>
            </a>
            <div class="menu-dropdown {{ $settingsOpen ? 'show' : '' }}">
                @can('settings.view')
                <a class="nav-link nav-sublink {{ $active('settings.index') }}" href="{{ route('settings.index') }}">
                    <i class="bi bi-sliders me-2"></i>General Settings
                </a>
                @endcan
                @can('settings.users.manage')
                <a class="nav-link nav-sublink {{ $active('settings.users*') }}" href="{{ route('settings.users') }}">
                    <i class="bi bi-people me-2"></i>User Management
                </a>
                @endcan
                @can('settings.roles.manage')
                <a class="nav-link nav-sublink {{ $active('settings.roles*') }}" href="{{ route('settings.roles') }}">
                    <i class="bi bi-person-badge me-2"></i>Role Management
                </a>
                @endcan
                @can('settings.permissions.manage')
                <a class="nav-link nav-sublink {{ $active('settings.permissions*') }}" href="{{ route('settings.permissions') }}">
                    <i class="bi bi-key me-2"></i>Permissions
                </a>
                @endcan
            </div>
        </div>
        @endcanany

    </nav>

</aside>

@push('scripts')
<script>
    function toggleSubmenu(element) {
        const parent = element.parentElement;
        const dropdown = parent.querySelector('.menu-dropdown');

        parent.classList.toggle('open');
        if (dropdown) {
            dropdown.classList.toggle('show');
        }
    }

    // Open submenu if any child is active (on page load)
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.menu-dropdown .nav-sublink.active').forEach(link => {
            const parent = link.closest('.has-submenu');
            if (parent) {
                parent.classList.add('open');
                const dropdown = parent.querySelector('.menu-dropdown');
                if (dropdown) {
                    dropdown.classList.add('show');
                }
            }
        });
    });
</script>
@endpush