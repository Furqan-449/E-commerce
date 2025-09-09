<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Categories\Categorie;

class Items extends Controller
{
    //
    public function all_items()
    {
        $user = Auth::guard('admin')->user();
        $it_data = Item::ownerproducts($user->id)->paginate(5);
        return view("pages/items/items", ["data" => $it_data]);
    }
    public function search_items(Request $request)
    {
        $valid = $request->validate([
            'search_item' => 'required | string',
        ]);
        $find = Item::productsearch(strtolower($valid['search_item']))->paginate(5);
        return view('pages.items.items', ["data" => $find]);
    }
    public function item_form()
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $categories = Categorie::slidecategory($user->id);
            if ($categories->isNotEmpty()) {
                do {
                    $item_num = "SKU-" . rand(1000, 9999);
                } while (Item::where('sku',  $item_num)->exists());

                return view("pages/items/add_item", ["it_num" => $item_num, "categories" => $categories]);
            } else {
                return redirect()->route('items')->with(['no_cat_error' => 'Please add a category first.']);
            }
        }
        return redirect()->route('login');
    }

    public function show_sub_category($id)
    {
        $sub_categories = Categorie::subcategory($id);
        return response()->json(['subcategories' => $sub_categories], 200);
    }

    public function add_item(Request $request)
    {
        $validate = $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg|max:2028",
            "name" => "required|string",
            "category" => "required|integer",
            "subcategory" => "nullable|integer",
            "sku" => "required|string",
            "price" => "required|numeric",
            "stock" => "required|integer",
        ], [
            'image.required' => 'Image required',
            'image.mimes' => 'Image should be jpeg,png,jpg',
            'image.max' => 'Image max size 2024MB',
            'name.required' => 'Name required',
            'category.required' => 'Category required',
            'sku.required' => 'SKU required',
            'price.required' => 'Price required',
            'price.numeric' => 'Price should be number',
            'stock.required' => 'Stock required',
            'stock.integer' => 'Stock should be number',

        ]);
        $item_data = new Item();
        $path = $request->file('image')->store("items", "public");
        $split = explode('/', $path);
        $get = $split[1];
        $item_data->image = $get;
        $item_data->name = $validate['name'];
        $item_data->sku = $validate['sku'];
        $item_data->price = $validate['price'];
        $item_data->quantity = $validate['stock'];
        $item_data->created_by = Auth::guard('admin')->id();

        $item_data->category_id =  $request->filled("subcategory") ?
            $validate['subcategory'] : $validate['category'];

        $item_data->save();
        return redirect()->route("items")->with('success', 'item added!');
    }

    public function edit_item($id)
    {
        $item = Item::with('category')->finditem($id);

        // Fetch only parent categories (top-level)
        $categories = Categorie::where('created_by', Auth::guard('admin')->id())
            ->whereNull('parent_id')
            ->get();

        // Determine selected parent category
        $category = $item->category; // assumed relation
        $selectedCategory = $category && $category->parent_id ? $category->parent_id : $item->category_id;
        $selectedSubCategory = $category && $category->parent_id ? $item->category_id : null;

        return view('pages.items.edit_item', [
            'data' => $item,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'selectedSubCategory' => $selectedSubCategory,
        ]);
    }

    public function update_item(Request $request, $id)
    {
        $validate = $request->validate([
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:2028",
            "name" => "required|string",
            "category" => "required|integer",
            "subcategory" => "nullable|integer",
            "sku" => "required|string",
            "price" => "required|numeric",
            "stock" => "required|integer",
        ], [
            'image.mimes' => 'Image should be jpeg,png,jpg',
            'image.max' => 'Image max size 2024MB',
            'name.required' => 'Name required',
            'category.required' => 'Category required',
            'sku.required' => 'SKU required',
            'price.required' => 'Price required',
            'price.numeric' => 'Price should be number',
            'stock.required' => 'Stock required',
            'stock.integer' => 'Stock should be number',

        ]);
        $item_data = Item::finditem($id);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store("items", "public");
            $split = explode('/', $path);
            $get = $split[1];
            $item_data->image = $get;
        }
        $item_data->name = $validate['name'];
        $item_data->price = $validate['price'];
        $item_data->quantity = $validate['stock'];
        $item_data->created_by = Auth::guard('admin')->id();
        $item_data->category_id = $request->filled("subcategory") ?
            $validate['subcategory'] : $validate['category'];

        $item_data->save();
        return redirect()->route("items")->with('success', 'item updated!');
    }
    public function delete_item($id)
    {
        $del_item = Item::finditem($id);
        $del_item->delete();
        return redirect()->route('items')->with('delete', 'Item deleted!');
    }

    public function cancle()
    {
        return redirect()->route('items');
    }
}
