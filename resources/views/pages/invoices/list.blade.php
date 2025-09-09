<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/invoices/list.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="dashboard">
        {{-- {/* Sidebar Navigation (Same as dashboard) */} --}}
        <aside class="sidebar">
            @include('include')

        </aside>

        {{-- {/* Main Content */} --}}
        <main class="maincontent">
            {{-- {/* Header */} --}}
            @include('header',['pageTitle' => 'Invoices'])

            {{-- {/* Header (Commented out) */} --}}
            {{-- <div class="header">
                <div class="page-title">Invoices</div>
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
            <div class="listcontrols">
                <div class="searchfilter">
                    <div class="searchbox">
                        <i class="fas fa-search searchicon"></i>
                        <input type="text" placeholder="Search invoices..." />
                    </div>
                    <div class="filterdropdown">
                        <button class="filterbtn">
                            <i class="fas fa-filter"></i>
                            Filter
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="filtermenu">
                            <div class="filteroption">
                                <input type="checkbox" id="filterpaid" checked />
                                <label for="filterpaid">Paid</label>
                            </div>
                            <div class="filteroption">
                                <input type="checkbox" id="filterpending" checked />
                                <label for="filterpending">Pending</label>
                            </div>
                            <div class="filteroption">
                                <input type="checkbox" id="filteroverdue" checked />
                                <label for="filteroverdue">Overdue</label>
                            </div>
                            <div class="filteroption">
                                <input type="checkbox" id="filterdraft" />
                                <label for="filterdraft">Drafts</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actionbuttons">
                    <button class="btn btnoutline">
                        <i class="fas fafile-export"></i>
                        Export
                    </button>
                    <a href="{{ route('new_invoice') }}" style="text-decoration: none">
                        <button class="btn btnprimary">
                            <i class="fas fa-plus"></i>
                            New Invoice
                        </button></a>
                </div>
            </div>

            {{-- {/* Invoice Table */} --}}
            <div class="invoicetablecontainer">
                <table class="invoicetable">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="invoiceclient">
                                    <div class="clientavatar">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client Avatar" />
                                    </div>
                                    <div class="clientinfo">
                                        <span class="clientname">Acme Corp</span>
                                        <span class="clientemail">billing@acme.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="invoicenumber">#INV2023045</span>
                            </td>
                            <td>
                                <span class="invoicedate">Nov 15, 2023</span>
                            </td>
                            <td>
                                <span class="invoicedate">Dec 15, 2023</span>
                            </td>
                            <td>
                                <span class="invoiceamount">$1,250.00</span>
                            </td>
                            <td>
                                <span class="invoicestatus statuspaid">Paid</span>
                            </td>
                            <td>
                                <div class="invoiceactions">
                                    <button class="actionbtn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="actionbtn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="actionbtn delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoiceclient">
                                    <div class="clientavatar">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    <div class="clientinfo">
                                        <span class="clientname">Bright Solutions</span>
                                        <span class="clientemail">finance@bright.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="invoicenumber">#INV2023044</span>
                            </td>
                            <td>
                                <span class="invoicedate">Nov 10, 2023</span>
                            </td>
                            <td>
                                <span class="invoicedate">Dec 10, 2023</span>
                            </td>
                            <td>
                                <span class="invoiceamount">$2,450.00</span>
                            </td>
                            <td>
                                <span class="invoicestatus statussent">Sent</span>
                            </td>
                            <td>
                                <div class="invoiceactions">
                                    <button class="actionbtn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="actionbtn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="actionbtn delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoiceclient">
                                    <div class="clientavatar">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    <div class="clientinfo">
                                        <span class="clientname">Tech Innovators</span>
                                        <span class="clientemail">
                                            accounts@techinnovators.com
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="invoicenumber">#INV2023043</span>
                            </td>
                            <td>
                                <span class="invoicedate">Nov 5, 2023</span>
                            </td>
                            <td>
                                <span class="invoicedate">Nov 20, 2023</span>
                            </td>
                            <td>
                                <span class="invoiceamount">$850.00</span>
                            </td>
                            <td>
                                <span class="invoicestatus statusoverdue">
                                    Overdue
                                </span>
                            </td>
                            <td>
                                <div class="invoiceactions">
                                    <button class="actionbtn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="actionbtn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="actionbtn delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoiceclient">
                                    <div class="clientavatar">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    <div class="clientinfo">
                                        <span class="clientname">Global Designs</span>
                                        <span class="clientemail">
                                            payments@globaldesigns.com
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="invoicenumber">#INV2023042</span>
                            </td>
                            <td>
                                <span class="invoicedate">Nov 1, 2023</span>
                            </td>
                            <td>
                                <span class="invoicedate">Dec 1, 2023</span>
                            </td>
                            <td>
                                <span class="invoiceamount">$3,200.00</span>
                            </td>
                            <td>
                                <span class="invoicestatus statuspaid">Paid</span>
                            </td>
                            <td>
                                <div class="invoiceactions">
                                    <button class="actionbtn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="actionbtn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="actionbtn delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoiceclient">
                                    <div class="clientavatar">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg"
                                            alt="Client Avatar" />
                                    </div>
                                    <div class="clientinfo">
                                        <span class="clientname">Data Systems</span>
                                        <span class="clientemail">
                                            invoices@datasystems.com
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="invoicenumber">#INV2023041</span>
                            </td>
                            <td>
                                <span class="invoicedate">Oct 28, 2023</span>
                            </td>
                            <td>
                                <span class="invoicedate">Nov 28, 2023</span>
                            </td>
                            <td>
                                <span class="invoiceamount">$1,750.00</span>
                            </td>
                            <td>
                                <span class="invoicestatus statussent">Sent</span>
                            </td>
                            <td>
                                <div class="invoiceactions">
                                    <button class="actionbtn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="actionbtn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="actionbtn delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoiceclient">
                                    <div class="clientavatar">
                                        <div class="clientavatar">
                                            <i class="fas fa-building" style="color: #6c757d; fontsize: 1rem"></i>
                                        </div>
                                    </div>
                                    <div class="clientinfo">
                                        <span class="clientname">North Industries</span>
                                        <span class="clientemail">
                                            accounting@northind.com
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="invoicenumber">#INV2023040</span>
                            </td>
                            <td>
                                <span class="invoicedate">Oct 22, 2023</span>
                            </td>
                            <td>
                                <span class="invoicedate">Nov 22, 2023</span>
                            </td>
                            <td>
                                <span class="invoiceamount">$5,600.00</span>
                            </td>
                            <td>
                                <span class="invoicestatus statusdraft">Draft</span>
                            </td>
                            <td>
                                <div class="invoiceactions">
                                    <button class="actionbtn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="actionbtn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="actionbtn delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- {/* Pagination */} --}}
            <div class="pagination">
                <div class="paginationinfo">Showing 1 to 6 of 24 invoices</div>
                <div class="paginationcontrols">
                    <button class="pagebtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="pagebtn active">1</button>
                    <button class="pagebtn">2</button>
                    <button class="pagebtn">3</button>
                    <button class="pagebtn">4</button>
                    <button class="pagebtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
