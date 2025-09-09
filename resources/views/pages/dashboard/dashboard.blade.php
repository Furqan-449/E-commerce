<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/dashboard/dashboard.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>DashBoard</title>
</head>

<body>
    <div class="dashboard">
        {{-- {/*  Sidebar Navigation  */} --}}
        <aside class="sidebar">
            @include('include')
        </aside>
        {{-- {/* Main Content */} --}}
        <main class="main-content">
            {{-- {/*  Header */} --}}
            @include('header', ['pageTitle' => 'Dashboard Overview'])

            {{-- {/*  Stats Cards */} --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Revenue</div>
                        <div class="stat-icon primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="stat-value">${{ $amount }}</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        12% from last month
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Unpaid Invoices</div>
                        <div class="stat-icon warning">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-value">8</div>
                    <div class="stat-value">$3,250</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Paid This Month</div>
                        <div class="stat-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="stat-value">$8,420</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        18% from last month
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Overdue Invoices</div>
                        <div class="stat-icon danger">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                    <div class="stat-value">3</div>
                    <div class="stat-value">$1,150</div>
                </div>
            </div>

            {{-- {/* Quick Actions */} --}}
            <div class="quick-actions">
                <a href="{{ route('invoice.create') }}" style="color: black; text-decoration: none;">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3 class="action-title">New Invoice</h3>
                        <p class="action-desc">Create and send a new invoice</p>
                    </div>
                </a>
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3 class="action-title">Add Client</h3>
                    <p class="action-desc">Add a new client to your system</p>
                </div>
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-file-import"></i>
                    </div>
                    <h3 class="action-title">Import Data</h3>
                    <p class="action-desc">Import clients or invoices</p>
                </div>
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-file-export"></i>
                    </div>
                    <h3 class="action-title">Export Reports</h3>
                    <p class="action-desc">Download financial reports</p>
                </div>
            </div>

            {{-- {/*  Charts Section */} --}}
            <div class="charts-section">
                <div class="chart-card">
                    <div class="chart-header">
                        <h2 class="chart-title">Revenue Overview</h2>
                        <div class="chart-period">
                            <button class="period-btn">Week</button>
                            <button class="period-btn active">Month</button>
                            <button class="period-btn">Year</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart" style="width: 100%"></canvas>

                    </div>
                </div>
                <div class="chart-card">
                    <div class="chart-header">
                        <h2 class="chart-title">Invoice Status</h2>
                    </div>
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                        {{-- <ResponsiveContainer>
                  <PieChart>
                    <Pie
                      data={data02}
                      dataKey="value"
                      nameKey="name"
                      cx="50%"
                      cy="50%"
                      outerRadius={100}
                      innerRadius={69}
                      fill="#8884d8"
                      // label
                    >
                      {data02.map((entry, index) => (
                        <Cell
                          key={`cell-${index}`}
                          fill={COLORS[index % COLORS.length]}
                        />
                      ))}
                    </Pie>
                    <Tooltip />
                    <Legend />
                  </PieChart>
                </ResponsiveContainer> --}}
                    </div>
                </div>
            </div>

            {{-- {/* Recent Activity */} --}}
            <div class="activity-card">
                <div class="activity-header">
                    <h2 class="activity-title">Recent Activity</h2>
                    <a href="#" class="view-all">
                        View All
                    </a>
                </div>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="activity-details">
                            <p class="activity-message">
                                Invoice
                                <span class="activity-client">#INV-2023-045</span> for
                                <span class="activity-client">Acme Corp</span> was paid
                                <span class="activity-amount">$1,250.00</span>
                            </p>
                            <p class="activity-time">2 hours ago</p>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-details">
                            <p class="activity-message">
                                New client
                                <span class="activity-client">Global Tech</span> added
                            </p>
                            <p class="activity-time">Yesterday</p>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="activity-details">
                            <p class="activity-message">
                                Invoice
                                <span class="activity-client">#INV-2023-044</span> sent
                                to
                                <span class="activity-client">Bright Solutions</span>
                            </p>
                            <p class="activity-time">2 days ago</p>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- {/*  Recent Invoices  */} --}}
            <div class="invoices-card">
                <div class="invoices-header">
                    <h2 class="invoices-title">Recent Invoices</h2>
                    <a href="#" class="view-all">
                        View All
                    </a>
                </div>
                <table class="invoices-table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="invoice-client">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    <span>Acme Corp</span>
                                </div>
                            </td>
                            <td>#INV-2023-045</td>
                            <td>Nov 15, 2023</td>
                            <td>$1,250.00</td>
                            <td>
                                <span class="invoice-status status-paid">Paid</span>
                            </td>
                            <td>
                                <button class="action-btn">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoice-client">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    <span>Bright Solutions</span>
                                </div>
                            </td>
                            <td>#INV-2023-044</td>
                            <td>Nov 10, 2023</td>
                            <td>$2,450.00</td>
                            <td>
                                <span class="invoice-status status-pending">
                                    Pending
                                </span>
                            </td>
                            <td>
                                <button class="action-btn">Remind</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoice-client">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    <span>Tech Innovators</span>
                                </div>
                            </td>
                            <td>#INV-2023-043</td>
                            <td>Nov 5, 2023</td>
                            <td>$850.00</td>
                            <td>
                                <span class="invoice-status status-overdue">
                                    Overdue
                                </span>
                            </td>
                            <td>
                                <button class="action-btn">Resend</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    @vite(['resources/js/dashboard'])
</body>

</html>
