<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/pages/clients/clients.css', 'resources/js/app.js')
    <title>Clients</title>
    </style>
</head>

<body>
    <div class="dashboard">
        {{-- {/* Sidebar Navigation */} --}}
        <aside class="sidebar">
            @include('include')
            {{-- <div class="logo">
                <i class="fas fa-file-invoice logo-icon"></i>
                <span class="logo-text">SmartInvoice</span>
            </div>
            <nav class="nav-menu">
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-invoice"></i>
                        Invoices
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-users"></i>
                        Clients
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Reports
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                </div>
            </nav> --}}
        </aside>

        {{-- {/* Main Content */} --}}
        <main class="main-content">
            {{-- {/* Header */} --}}
            @include('header', ['pageTitle' => 'Clients'])

            {{-- {/* Breadcrumbs */} --}}

            {{-- {/* Page Title */} --}}
            {{-- <div class="header">
                <h1 class="page-title">Clients</h1>
                <div class="user-menu">
                    <div class="notification-bell">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User Avatar" />
                    </div>
                </div>
            </div> --}}

            {{-- {/* List Controls */} --}}
            <div class="list-controls">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <form action="search-client" style="display: flex">
                        @csrf
                        <input type="text" class="form-control" placeholder="Search clients..." id="search"
                            name="search" />
                        <button class="btn btn-outline" style="margin-left: 10px">search</button>
                    </form>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-outline">
                        <i class="fas fa-file-export"></i> Export
                    </button>
                    <a href="{{ route('addclient') }}" style="text-decoration:none;">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> New Client
                        </button></a>
                </div>
            </div>

            {{-- {/* Clients Table */} --}}
            <div class="clients-table-container">
                <table class="clients-table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Invoices</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $cli_data)
                            <tr>
                                <td>
                                    <div class="client-info">
                                        <div class="client-avatar">
                                            <img src="{{ asset('storage/clients/' . $cli_data->image) }}"
                                                alt="Client Avatar" />
                                        </div>
                                        <div>
                                            <div class="client-name">{{ $cli_data->name }}
                                            </div>
                                            <div class="client-email">{{ $cli_data->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="client-company">{{ $cli_data->company }}</div>
                                </td>
                                <td>
                                    <div>{{ $cli_data->phone }}</div>
                                </td>
                                <td>
                                    <div>12</div>
                                </td>
                                <td>
                                    <span class="client-active active-true">Active</span>
                                </td>
                                <td>
                                    <div class="client-actions">
                                        {{-- <button class="action-btn view" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button> --}}
                                        <a href="{{ route('editclient', $cli_data->id) }}"
                                            style="text-decoration: none">
                                            <button class="action-btn edit" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </button></a>
                                        <a href="{{ route('deleteclient', $cli_data->id) }}"
                                            style="text-decoration: none">
                                            <button class="action-btn delete" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{-- {{ $data->links() }} --}}
            </div>

            {{-- {/* Pagination */} --}}
            <div class="pagination">
                <div class="pagination-info">Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of
                    {{ $data->total() }} clients</div>
                <div class="pagination-controls">
                    @if ($data->onFirstPage())
                        <button class="page-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    @else
                        <a href="{{ $data->previousPageUrl() }}" class="page-btn" style="text-decoration: none">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @for ($i = 1; $i <= $data->lastPage(); $i++)
                        <a href="{{ $data->url($i) }}"
                            class="page-btn {{ $data->currentPage() == $i ? 'active' : '' }}"
                            style="text-decoration: none">
                            {{ $i }}
                        </a>
                    @endfor

                    @if ($data->hasMorePages())
                        <a href="{{ $data->nextPageUrl() }}" class="page-btn" style="text-decoration: none">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <button class="page-btn" disabled>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                {{--  {{ $data->links('pagination::bootstrap-5') }}
                    <button class="page-btn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn">
                        <i class="fas fa-chevron-right"></i>
                    </button> --}}
            </div>
    </div>
    </main>
    </div>
</body>

</html>
