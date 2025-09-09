<div class="logo">
    <i class="fas fa-file-invoice logo-icon"></i>
    <span class="logo-text">SmartInvoice</span>
</div>
<nav class="nav-menu">
    <div class="nav-item">
        <a href="{{ route('dashboard') }}"
            class="nav-link {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-home i"></i>
            Dashboard
        </a>
    </div>
    {{-- <div class="nav-item">
        <a href="{{ route('invoices') }}"
            class="nav-link {{ Route::currentRouteName() === 'invoices' ? 'active' : '' }}">
            <i class="fas fa-file-invoice i"></i>
            Invoices
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('clients') }}" class="nav-link {{ Route::currentRouteName() === 'clients' ? 'active' : '' }}">
            <i class="fas fa-users i"></i>
            Clients
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('reports') }}" class="nav-link {{ Route::currentRouteName() === 'reports' ? 'active' : '' }}">
            <i class="fas fa-chart-line i"></i>
            Reports
        </a>
    </div> --}}
    <div class="nav-item">
        <a href=" {{ route('items') }}  " class="nav-link {{ Route::currentRouteName() === 'items' ? 'active' : '' }}">
            <i class="fas fa-boxes i"></i>
            Items
        </a>
    </div>
    <!-- In your sidebar file (include.blade.php) -->
    <div class="nav-item">
        <a href="{{ route('categories') }}"
            class="nav-link {{ Route::currentRouteName() === 'categories' ? 'active' : '' }}">
            <i class="fas fa-tags i"></i>
            Categories
        </a>
    </div>
    <div class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-cog i"></i>
            Settings
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">
            <i class="fas fa-sign-out i"></i>
            Logout
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('delete_account') }}" class="nav-link">
            <i class="fas fa-trash i"></i>
            Delete Account
        </a>
    </div>
</nav>
