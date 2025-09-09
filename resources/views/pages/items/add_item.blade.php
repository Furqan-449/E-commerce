<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/items/add_item.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="main-content">
        {{-- Header --}}
        <div class="header">
            <h1 class="page-title">Add New Item</h1>
        </div>

        {{-- Item Form --}}
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Item Information</h2>
            </div>

            <form id="itemForm" action="add_item" method="post" enctype="multipart/form-data">
                @csrf
                {{-- Image Upload --}}
                <div class="avatar-upload">
                    <div class="avatar-preview" id="itemImagePreview">
                        <div class="avatar-placeholder">
                            {{-- <i class="fas fa-box"></i> --}}
                        </div>
                        <img id="itemImageDisplay" style="display: none;" />
                    </div>
                    <div class="avatar-upload-btn">
                        <button type="button" class="btn-upload">
                            <i class="fas fa-upload"></i> Upload Image
                        </button>
                        <input type="file" id="itemImageInput" accept="image/*" name="image" />
                        <span style="color: red">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                {{-- Item Details --}}
                <div class="form-group">
                    <label for="itemName" class="form-label">Item Name</label>
                    <input type="text" id="itemName" class="form-control" placeholder="Enter item name"
                        name="name" value="{{ old('name') }}">
                    <span style="color: red">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" class="form-control form-select" name="category">
                                <option value="">--Select category--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span style="color: red">
                                @error('category')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group" id="otherCategoryGroup" style="display: none;">
                            <label for="otherCategory" class="form-label">Category Name</label>
                            <select name="subcategory" id="otherCategory" class="form-control"></select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" id="sku" class="form-control" placeholder="Enter SKU"
                                name="sku" value="{{ $it_num }}" readonly>
                            <span style="color: red">
                                @error('sku')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" id="price" class="form-control" placeholder="0.00" step="0.01"
                                min="0" name="price" value="{{ old('price') }}">
                            <span style="color: red">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="stock" class="form-label">Stock Quantity</label>
                            <input type="number" id="stock" class="form-control" placeholder="0" min="0"
                                name="stock" value="{{ old('stock') }}">
                            <span style="color: red">
                                @error('stock')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="form-actions">
                    <a href="{{ route('cancle') }}" style="text-decoration: none;">
                        <button type="button" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </button></a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    @vite(['resources/js/items/add_item.js'])
</body>

</html>
