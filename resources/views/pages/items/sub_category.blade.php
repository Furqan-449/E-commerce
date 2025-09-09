<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/items/sub_category.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="container">
        <!-- Category Header -->
        <div class="category-header">
            <h1 class="category-title">{{ $parent->name }} <span>(Parent Category)</span></h1>
            <button class="btn btn-primary" id="add-subcategory">
                <i class="fas fa-plus"></i>
                Add Subcategory
            </button>
        </div>
        @if (session('delete'))
            <div class="alert alert-danger"
                style="border: 1px solid #e74c3c; background: #fdecea; color: #e74c3c; padding: 10px; border-radius: 6px; text-align: center; width: 30%; margin:0px auto 10px auto; display: flex; justify-content:space-around">
                {{ session('delete') }}
            </div>
        @endif
        <!-- Subcategories Table -->
        <div class="subcategory-table-container">
            <table class="subcategory-table">
                <thead>
                    <tr>
                        <th>Subcategory Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data - replace with dynamic content from your backend -->
                    @if ($categories->isEmpty())
                        <tr style="text-align: center;color: red; font-size: 1.5rem;">
                            <td colspan="2" class="no-data">No subcategories found.</td>
                        </tr>
                    @else
                        @foreach ($categories as $category)
                            <tr>
                                <td class="subcategory-name">{{ $category->name }}</td>
                                <td>
                                    <div class="subcategory-actions">
                                        {{-- <button class="action-btn edit" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button> --}}
                                        <a href="{{ route('delete_sub_category', $category->id) }}"
                                            style="text-decoration: none">
                                            <button class="action-btn delete" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <!-- End sample data -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <div class="pagination-info">Showing 1 to 3 of 3 subcategories</div>
            <div class="pagination-controls">
                <button class="page-btn" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn" disabled>
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Add Subcategory Modal -->
    <div class="modal-overlay" id="subcategory-modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Subcategory</h3>
            </div>
            <div class="modal-body">
                <form id="subcategory-form">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="" id="parent_id" value="{{ $parent->id }}">
                        <label for="subcategory-name">Subcategory Name</label>
                        <input type="text" id="subcategory-name" name="name" value=""
                            placeholder="Enter subcategory name">
                        <span id="error" style="color: red"></span>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline close-modal" id="close-box">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Messages Block -->
    <div class="modal-overlay" id="messageBlock" style="display: none;">
        <div class="modal-content" style="text-align: center;">
            <div div class="modal-body">
                <h3 id="messages"></h3>
            </div>
        </div>
    </div>

    @vite(['resources/js/items/sub_category.js']);

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) alert.style.display = 'none';
        }, 1000);
    </script>
</body>

</html>
