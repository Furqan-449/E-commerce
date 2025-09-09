<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/items/edit_category.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="edit-category-container">
        <!-- Edit Category Form -->
        <div class="modal-content" style="margin: 50px auto; max-width: 500px;">
            <div class="modal-header">
                <h3>Edit Category</h3>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" action="" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="editCategoryName">Category Name</label>
                        <input type="text" id="editCategoryName" name="categoryName" value="{{$category->name}}"
                            placeholder="New category name" required>
                        <span id="edit-cat-error-message"></span>
                    </div>
                    <div class="form-actions">
                        <a href="" class="btn btn-outline">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
