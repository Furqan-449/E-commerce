<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/invoices/create.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="create-invoice-container">
        <div class="invoice-header">
            <h1 class="invoice-title">Create New Invoice</h1>
            <div class="invoice-actions">
                <button class="btn btn-outline">
                    <i class= "fas fa-arrow-left"></i> Back
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-save"></i> Save Draft
                </button>
                <button class="btn btn-primary">
                    <i class=" fas fa-file-pdf"></i> Preview
                </button>
            </div>
        </div>
        {{-- <form action="#" method="">
            @csrf --}}
            <div class="invoice-form">
                <div class="invoice-details">
                    <h2 class="section-title">Invoice Details</h2>

                    <div class="form-group">
                        <label htmlFor="client">Client</label>
                        <select id="client" class="form-control">
                            <option value="">Select a client</option>
                            <option value="1">Acme Corp</option>
                            <option value="2">Bright Solutions</option>
                            <option value="3">Tech Innovators</option>
                        </select>
                    </div>
                    {{-- INV-2023-001 --}}
                    <div class="form-group">
                        <label htmlFor="invoice-number">Invoice Number</label>
                        <input type="text" id="invoice-number" class="form-control" value="{{ $invoice_number }}"
                            readOnly />
                    </div>

                    {{-- <div class="form-group">
                    <label htmlFor="invoice-date">Invoice Date</label>
                    <input type="date" id="invoice-date" class="form-control" />
                </div> --}}

                    <div class="form-group">
                        <label htmlFor="due-date">Due Date</label>
                        <input type="date" id="due-date" class="form-control" />
                    </div>

                    <h2 class="section-title" style="marginTop: 2rem">
                        Items
                    </h2>

                    <table class="items-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="item-row">
                                <td>
                                    <input type="text" class="item-input" placeholder="Description" />
                                </td>
                                <td>
                                    <input type="number" class="item-input" placeholder="1" />
                                </td>
                                <td>
                                    <input type="number" class="item-input" placeholder="0.00" />
                                </td>
                                <td>$0.00</td>
                                <td>
                                    <button class="btn btn-outline" style="padding: 0.25rem 0.5rem">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="add-item-btn">
                        <i class=" fas fa-plus"></i> Add Item
                    </button>

                    <div class="form-group">
                        <label htmlFor="notes">Notes</label>
                        <textarea id="notes" class="form-control" rows="3" placeholder="Additional notes for the client"></textarea>
                    </div>
                </div>

                <div class="invoice-summary">
                    <h2 class="section-title">Summary</h2>

                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value">$0.00</span>
                    </div>

                    <div class="form-group">
                        <label htmlFor="tax-rate">Tax Rate (%)</label>
                        <input type="number" id="tax-rate" class="form-control" placeholder="0" />
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Tax</span>
                        <span class="summary-value">$0.00</span>
                    </div>

                    <div class="form-group">
                        <label htmlFor="discount">Discount</label>
                        <input type="number" id="discount" class="form-control" placeholder="0" />
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Discount</span>
                        <span class="summary-value">$0.00</span>
                    </div>

                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <span>$0.00</span>
                    </div>

                    <button class="btn btn-primary preview-btn">
                        <i class="fas fa-file-pdf"></i> Preview Invoice
                    </button>
                </div>
            </div>
        {{-- </form> --}}
    </div>
</body>

</html>
