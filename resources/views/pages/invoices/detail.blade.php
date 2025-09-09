<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/invoices/detail.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="invoice-detail-container">
        <div class="invoice-header">
            <div class="invoice-title">
                Invoice
                {{-- {invoice.id}
                <span class={`invoice-status ${statusClasses[invoice.status]}`}>
                    {invoice.status.charAt(0).toUpperCase() + invoice.status.slice(1)}
                </span> --}}
            </div>
            <div class="invoice-actions">
                <button class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <button class="btn btn-outline">
                    <i class=" fas fa-print"> </i> Print
                </button>
                <button class="btn btn-primary">
                    <i class=" fas fa-file-pdf"></i> Download PDF
                </button>
                {{-- {invoice.status === "sent" && ( --}}
                <button class="btn btn-primary">
                    <i class=" fas fa-envelope"></i> Resend
                </button>
                {{-- )} --}}
                {{-- {invoice.status !== "paid" && ( --}}
                <button class="btn btn-primary">
                    <i class= "fas fa-money-billWave"></i> Record Payment
                </button>
                {{-- )} --}}
            </div>
        </div>

        <div class="invoice-card">
            <div class="invoice-meta">
                <div class="meta-group">
                    <span class="meta-label">Invoice Date</span>
                    <span class="meta-value">
                        {{-- {new Date(invoice.date).toLocaleDateString("en-US", {
                        year: "numeric",
                        month: "long",
                        day: "numeric",
                        })} --}}
                    </span>
                </div>
                <div class="meta-group">
                    <span class="meta-label">Due Date</span>
                    <span class="meta-value">
                        {{-- {new Date(invoice.dueDate).toLocaleDateString("en-US", {
                        year: "numeric",
                        month: "long",
                        day: "numeric",
                        })} --}}
                    </span>
                </div>
                <div class="meta-group">
                    <span class="meta-label">Issued By</span>
                    <span class="meta-value">Your Company Name</span>
                </div>
            </div>

            <div class="client-info">
                <div class="client-avatar">
                    <img src={invoice.client.avatar} alt={invoice.client.name} />
                </div>
                <div class="client-details">
                    <h3>Jaof</h3>
                    <p class="client-email">email</p>
                    <pre class="client-email" style="marginTop: 0.5rem">
                Street
              </pre>
                </div>
            </div>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {invoice.items.map((item) => (
                    <tr key={item.id}>
                        <td>{item.description}</td>
                        <td>{item.quantity}</td>
                        <td>${item.price.toFixed(2)}</td>
                        <td class="item-total">
                            ${(item.quantity * item.price).toFixed(2)}
                        </td>
                    </tr>
                    ))} --}}
                </tbody>
            </table>

            <div class="summary-section">
                <div class="summary-notes">
                    <h3>Notes</h3>
                    {{-- <p>{invoice.notes}</p> --}}
                </div>
                <div class="summary-totals">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value">
                            {{-- ${invoice.subtotal.toFixed(2)} --}}
                        </span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Tax </span>
                        <span class="summary-value">
                            {{-- ${invoice.taxAmount.toFixed(2)} --}}
                        </span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Discount</span>
                        <span class="summary-value">
                            {{-- ${invoice.discount.toFixed(2)} --}}
                        </span>
                    </div>
                    <div class="summary-row summary-grand-total">
                        <span>Total Due</span>
                        {{-- <span>${invoice.total.toFixed(2)}</span> --}}
                    </div>
                </div>
            </div>

            {{-- {invoice.status !== "paid" && (
            <div class="payment-actions">
                <button class="btn btn-primary">
                    <FaCheck /> Mark as Paid
                </button>
                <button class="btn btn-outline">Send Payment Reminder</button>
                <button class="btn btn-outline">Edit Invoice</button>
            </div>
            )} --}}
        </div>

        <div class="invoice-card">
            <h2>Activity History</h2>
            {{-- {invoice.history.map((record) => (
            <div key={record.id} class="history-item">
                <div class="history-icon">{record.icon}</div>
                <div class="history-details">
                    <div class="history-action">{record.action}</div>
                    <div class="history-date">{record.date}</div>
                </div>
            </div>
            ))} --}}
        </div>
    </div>
</body>

</html>
