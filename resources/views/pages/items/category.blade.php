<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/items/category.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="dashboard">
        <!-- Keep your existing sidebar -->
        <aside class="sidebar">
            @include('include')
        </aside>

        <!-- Main content area -->
        <main class="maincontent">
            <div class="categories-management">
                <!-- Header with Add Button -->
                <div class="management-header">
                    <div class="header-left">
                        <h2><i class="fas fa-tags"></i> Category Management</h2>
                        <p class="subtitle">Organize your products with categories and subcategories</p>
                    </div>
                    <button id="add-category" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
                @if (session('delete'))
                    <div class="alert alert-danger"
                        style="border: 1px solid #e74c3c; background: #fdecea; color: #e74c3c; padding: 10px; border-radius: 6px; text-align: center; width: 30%; margin:0px auto 10px auto; display: flex; justify-content:space-around">
                        {{ session('delete') }}
                    </div>
                @endif
                <!-- Search and Filter -->
                <div class="management-controls">
                    <form action="{{ route('sear_cat_name') }}" style="display: flex" method="get">
                        @csrf
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search categories..." value="{{ request('catname') }}"
                                name="catname">

                        </div>
                        <div><button class="btn btn-outline">search</button></div>
                    </form>
                    {{-- <div class="filter-dropdown">
                        <select class="filter-select">
                            <option>All Categories</option>
                            <option>Parent Only</option>
                            <option>With Subcategories</option>
                        </select>
                    </div> --}}
                </div>

                <!-- Categories Table -->
                <div class="categories-table-container">
                    <table class="categories-table">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Type</th>
                                {{-- <th>Parent Category</th> --}}
                                <th>Parent</th>
                                {{-- <th>Items</th> --}}
                                {{-- <th>Last Updated</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="parent-category">
                                    <td>
                                        <div class="category-name-cell">
                                            {{-- <i class="fas fa-folder"></i> --}}
                                            <span>{{ $category->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($category->parent_id)
                                            <span class="badge badge-primary">Child</span>
                                    </td>
                                @else
                                    <span class="badge badge-primary" style="color: green">Parent</span></td>
                            @endif
                            <td>
                                @if ($category->parent)
                                    <span>{{ $category->parent->name }}</span>
                                @else
                                    <em>—</em>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-icon edit action-btn edit-category" data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <a href="{{ route('delete_category', $category->id) }}"
                                        style="text-decoration: none">
                                        <button class="btn-icon delete action-btn delete-category"
                                            data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                            title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button></a>
                                    @if ($category->parent_id == '')
                                        <button class="btn-icon add-sub add-subcategory" data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}" title="Add subcategory">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of
                        {{ $categories->total() }} categories
                    </div>
                    <div class="pagination-controls">
                        @if ($categories->onFirstPage())
                            <button class="page-btn disabled">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        @else
                            <a href="{{ $categories->previousPageUrl() }}" class="page-btn">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        @for ($i = 1; $i <= $categories->lastPage(); $i++)
                            <a href="{{ $categories->url($i) }}"
                                class="page-btn {{ $categories->currentPage() == $i ? 'active' : '' }}"
                                style="text-decoration: none">
                                {{ $i }}
                            </a>
                        @endfor

                        @if ($categories->hasMorePages())
                            <a href="{{ $categories->nextPageUrl() }}" class="page-btn">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <button class="page-btn disabled">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Category Modal -->
    <div class="modal-overlay" id="categoryModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Category</h3>
            </div>
            <div class="modal-body">
                <form id="categoryForm" action="{{ route('add_category_name') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" id="categoryName" name="categoryName" placeholder="add category">
                        <span id="add-cat-error-message">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline cancel-btn" id="cancel-category">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="add-new-category">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Category Modal -->
    <div class="modal-overlay" id="editCategoryModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Category</h3>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" action="" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editCategoryId" name="id">
                    <div class="form-group">
                        <label for="editCategoryName">Category Name</label>
                        <input type="text" id="editCategoryName" name="categoryName"
                            placeholder="new category name" required>
                        <span id="edit-cat-error-message">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline cancel-edit-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="update-category">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Add SubCategory Modal -->
    <div class="modal-overlay" id="subcategoryModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Sub Category</h3>
            </div>
            <div class="modal-body">
                <form id="categoryForm" action="" method="post">
                    @csrf
                    <input type="hidden" id="subcategoryId" name="id">
                    <input type="hidden" id="parent_id" name="parent_id">
                    <div class="form-group">
                        <div style="display: flex">
                            <label for="subcategoryName">Sub Category Name</label>
                            <p id="parent_of_sub"></p>
                        </div>
                        <input type="text" id="subcategoryName" name="subcategoryName"
                            placeholder="add sub category">
                        <span id="error" style="color: red"></span>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline cancel-sub-btn"
                            id="cancel-subcategory">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="add-sub-category">Add Sub
                            Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Messages Block -->
    <div class="modal-overlay" id="messageBlock" style="display: none;">
        <div class="modal-content" style="text-align: center;">
            <div class="modal-body">
                <h3 id="messages"></h3>
            </div>
        </div>
    </div>


    @vite(['resources/js/items/add_category.js']);

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) alert.style.display = 'none';
        }, 1000);
    </script>
</body>

</html>
