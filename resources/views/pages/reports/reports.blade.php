<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/reports/reports.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="dashboard">
        {{-- {/* <!-- Sidebar Navigation --> */} --}}
        <aside class="sidebar">
            @include('include')
            {{-- <div class="logo">
                <i class="fas fa-file-invoice logo-icon"></i>
                <span class="logo-text">SmartInvoice</span>
            </div>
            <nav class="nav-menu">
                <div class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="invoices" class="nav-link">
                        <i class="fas fa-file-invoice"></i>
                        Invoices
                    </a>
                </div>
                <div class="nav-item">
                    <a href="clients" class="nav-link">
                        <i class="fas fa-users"></i>
                        Clients
                    </a>
                </div>
                <div class="nav-item">
                    <a href="reports" class="nav-link active">
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
            </nav>  --}}
        </aside>

        {{-- {/* <!-- Main Content --> */} --}}
        <main class="main-content">
            {{-- {/* <!-- Header --> */} --}}
            @include('header',['pageTitle' => 'Reports'])
            {{-- <div class="header">
                <h1 class="page-title">Reports</h1>
                <div class="user-menu">
                    <div class="notification-bell">
                        <i class="fas fa-bell" ></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User Avatar" />
                    </div>
                </div>
            </div> --}}

            {{-- {/* <!-- Reports Controls --> */} --}}
            <div class="reports-controls">
                <div class="report-filters">
                    <div class="filter-group">
                        <label class="filter-label">Report Type</label>
                        <select class="filter-select">
                            <option>Revenue Overview</option>
                            <option>Invoice Status</option>
                            <option>Client Activity</option>
                            <option>Expense Breakdown</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Date Range</label>
                        <select class="filter-select">
                            <option>Last 7 Days</option>
                            <option>This Month</option>
                            <option>Last Month</option>
                            <option>This Quarter</option>
                            <option>This Year</option>
                            <option>Custom Range</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Client</label>
                        <select class="filter-select">
                            <option>All Clients</option>
                            <option>Acme Corporation</option>
                            <option>Bright Solutions</option>
                            <option>Tech Innovators</option>
                        </select>
                    </div>
                </div>
                <div class="export-actions">
                    <button class="btn btn-outline">
                        <i class="fas fa-file-export" ></i> Export
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-sync-alt" ></i> Refresh
                    </button>
                </div>
            </div>

            {{-- {/* <!-- Reports Grid --> */} --}}
            <div class="reports-grid">
                <div class="report-card">
                    <div class="report-header">
                        <h2 class="report-title">Revenue Overview</h2>
                        <span class="report-period">Nov 1 - Nov 30, 2023</span>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                    <div class="report-stats">
                        <div class="stat-item">
                            <span class="stat-value">$12,845</span>
                            <span class="stat-label">Total Revenue</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value" style="color: var(--success-color)">
                                +12%
                            </span>
                            <span class="stat-label">vs Last Month</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">24</span>
                            <span class="stat-label">Invoices</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">8</span>
                            <span class="stat-label">Active Clients</span>
                        </div>
                    </div>
                </div>
                <div class="report-card">
                    <div class="report-header">
                        <h2 class="report-title">Invoice Status</h2>
                        <span class="report-period">Current Month</span>
                    </div>
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="report-stats">
                        <div class="stat-item">
                            <span class="stat-value">$8,420</span>
                            <span class="stat-label">Paid</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">$3,250</span>
                            <span class="stat-label">Pending</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">$1,150</span>
                            <span class="stat-label">Overdue</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">3</span>
                            <span class="stat-label">Drafts</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- {/* <!-- Detailed Reports --> */} --}}
            <div class="detailed-reports">
                <div class="detailed-header">
                    <h2 class="detailed-title">Recent Invoices</h2>
                    <button class="btn btn-outline">View All Invoices</button>
                </div>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#INV-2023-045</td>
                            <td>
                                <div class="client-cell">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    Acme Corporation
                                </div>
                            </td>
                            <td>Nov 15, 2023</td>
                            <td>$1,250.00</td>
                            <td>
                                <span class="status-badge status-paid">Paid</span>
                            </td>
                        </tr>
                        <tr>
                            <td>#INV-2023-044</td>
                            <td>
                                <div class="client-cell">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    Bright Solutions
                                </div>
                            </td>
                            <td>Nov 10, 2023</td>
                            <td>$2,450.00</td>
                            <td>
                                <span class="status-badge status-pending">Pending</span>
                            </td>
                        </tr>
                        <tr>
                            <td>#INV-2023-043</td>
                            <td>
                                <div class="client-cell">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    Tech Innovators
                                </div>
                            </td>
                            <td>Nov 5, 2023</td>
                            <td>$850.00</td>
                            <td>
                                <span class="status-badge status-pending">Pending</span>
                            </td>
                        </tr>
                        <tr>
                            <td>#INV-2023-042</td>
                            <td>
                                <div class="client-cell">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    Global Designs
                                </div>
                            </td>
                            <td>Nov 1, 2023</td>
                            <td>$3,200.00</td>
                            <td>
                                <span class="status-badge status-paid">Paid</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- {/* <!-- Report Types --> */} --}}
            <h2 style="marginBottom: 1rem">Other Reports</h2>
            <div class="report-types">
                <div class="type-card">
                    <div class="type-icon">
                        <i class="fas fa-user-clock" ></i>
                    </div>
                    <h3 class="type-title">Aging Report</h3>
                    <p class="type-desc">Track overdue invoices and payment delays</p>
                </div>
                <div class="type-card">
                    <div class="type-icon">
                        <i class="fas fa-money-bill-wave" ></i>
                    </div>
                    <h3 class="type-title">Payment History</h3>
                    <p class="type-desc">Detailed record of all payments received</p>
                </div>
                <div class="type-card">
                    <div class="type-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3 class="type-title">Product Sales</h3>
                    <p class="type-desc">Breakdown of services/products sold</p>
                </div>
                <div class="type-card">
                    <div class="type-icon">
                        <i class="fas fa-file-invoice-dollar" ></i>
                    </div>
                    <h3 class="type-title">Tax Summary</h3>
                    <p class="type-desc">Tax collected by period and jurisdiction</p>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
