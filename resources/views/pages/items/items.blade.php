<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/items/items.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="dashboard">
        {{--  Sidebar Navigation  --}}
        <aside class="sidebar">
            @include('include')
        </aside>

        {{--  Main Content --}}
        <main class="maincontent">
            {{--  Header --}}
            @include('header', ['pageTitle' => 'Items'])
            @if (session('no_cat_error'))
                <div class="alert alert-danger"
                    style="border: 1px solid #e74c3c; background: #fdecea; color: #e74c3c; padding: 10px; border-radius: 6px; text-align: center; width: 30%; margin:0px auto 10px auto; display: flex; justify-content:space-around">
                    {{ session('no_cat_error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-danger"
                    style="border: 1px solid #08dc20; background: #fdecea; color: green; padding: 10px; border-radius: 6px; text-align: center; width: 30%; margin:0px auto 10px auto; display: flex; justify-content:space-around">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('delete'))
                <div class="alert alert-danger"
                    style="border: 1px solid #e74c3c; background: #fdecea; color: red; padding: 10px; border-radius: 6px; text-align: center; width: 30%; margin:0px auto 10px auto; display: flex; justify-content:space-around">
                    {{ session('delete') }}
                </div>
            @endif
            {{-- {/* <!-- List Controls --> */} --}}
            <div class="listcontrols">
                <div class="searchfilter">
                    <form action="{{route('search_item')}}" style="display: flex" method="get">
                        @csrf
                        <div class="searchbox">
                            <i class="fas fa-search searchicon"></i>
                            <input type="text" placeholder="Search items..." name="search_item" value="{{request('search_item')}}"/>
                        </div>

                        <div><button class="btn btn-outline">search</button></div>
                    </form>
                </div>
                <div class="actionbuttons">
                    <button class="btn btn-outline">
                        <i class="fas fa-file-export"></i>
                        Export
                    </button>
                    <a href="{{ route('item_form') }}" style="text-decoration: none">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Item
                        </button></a>
                </div>
            </div>

            <!-- Item Table -->
            <div class="itemtable-container">
                <table class="itemtable">
                    <thead>
                        <tr>
                            <th>Items</th>
                            {{-- <th>Category</th> --}}
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="7" class="no-data"
                                    style="text-align: center; font-size: 2rem; color: red;">No items</td>
                            </tr>
                        @else
                            @foreach ($data as $item_data)
                                <tr>
                                    <td>
                                        <div class="item-info">
                                            <div class="item-image">
                                                <img src="{{ asset('storage/items/' . $item_data->image) }}"
                                                    alt="Wireless Headphones" />
                                            </div>
                                            <div>
                                                <div class="item-name">{{ $item_data->name }}</div>
                                                {{-- <div class="item-category">{{ $item_data->name }}</div> --}}
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td>{{ $item_data->name }}</td> --}}
                                    <td>{{ $item_data->sku }}</td>
                                    <td class="item-price">${{ $item_data->price }}</td>
                                    <td class="item-stock">{{ $item_data->quantity }}</td>
                                    <td>
                                        <span class="item-status status-active">

                                            @if ($item_data->quantity > 0)
                                                Active
                                            @else
                                                Out
                                            @endif

                                        </span>
                                    </td>
                                    <td>
                                        <div class="item-actions">
                                            {{-- <button class="action-btn view" title="View">
                                                <a href="detail"> <i class="fas fa-eye"></i></a>
                                            </button>--}}
                                            <a href="{{route('edit_item',$item_data->id)}}" style="text-decoration: none">
                                            <button class="action-btn edit" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </button> </a>
                                            <a href="{{ route('delete_item', $item_data->id) }}"
                                                style="text-decoration: none">
                                                <button class="action-btn delete" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">

                <div class="pagination-info">Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of
                    {{ $data->total() }} items</div>
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

                    <!-- Page Numbers -->
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
                </div>
            </div>
        </main>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) alert.style.display = 'none';
        }, 1000);
    </script>

</body>

</html>
