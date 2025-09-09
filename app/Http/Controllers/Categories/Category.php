<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\Categorie;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Support\Facades\Auth;
use Psy\Command\WhereamiCommand;

class Category extends Controller
{
    //
    public function all_categories()
    {
        $user = Auth::guard('admin')->user();
        // Only fetch parent categories with their subcategories
        $categories = Categorie::with('subcategories')
            ->where('created_by', $user->id)
            ->paginate(5);
        return view("pages/items/category", ["categories" => $categories, 'user' => $user]);
    }
    public function add_category_name(Request $request)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }
        $validate = $request->validate([
            'categoryName' => 'required|string',
            'parent_id' => 'nullable|integer|exists:categories,id', // Optional parent
        ]);
        $cradential = strtolower($validate['categoryName']);
        $parentId = $validate['parent_id'] ?? null;
        $check = Categorie::where('name', $cradential)->where('parent_id', $parentId)->first();
        if ($check) {
            return response()->json([
                'error' => 'Category already exists.'
            ],  400);
            // return redirect()->back()->with('error', 'Category already exists.');
        } else {
            $category = new Categorie();
            $category->name = $cradential;
            $category->created_by = Auth::guard('admin')->id(); // Assuming you want to associate it with the user ID
            $category->parent_id = $parentId; // Set parent_id if provided
            $category->save();
            return response()->json([
                'success' => 'Category added successfully!'
            ], 200);
            // return redirect()->back()->with('success', 'Category added successfully.');
        }
    }

    public function sear_cat_name(Request $request)
    {
        $valid = $request->validate([
            'catname' => 'required|string',
        ]);

        $lower = strtolower($valid['catname']);
        // Use LIKE for partial match
        $find = Categorie::where('name', 'like', "%$lower%")
            ->where('created_by', Auth::guard('admin')->id())
            ->paginate(5);
        $parentIds = $find->pluck('id');

        $sub_cat = Categorie::where('created_by', Auth::guard('admin')->id())
            ->whereIn('parent_id', $parentIds)
            ->get();
        return view("pages/items/category", ["categories" => $find, 'subcat' => $sub_cat]);
    }

    public function get_edit_category($id)
    {
        $find = Categorie::findOrFail($id);
        return view("pages.items.edit_category", ['category' => $find]);
    }
    public function edit_category(Request $request)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }
        $validate = $request->validate([
            "id" => "required|integer",
            "new_name" => "required|string",
        ]);

        $credential = strtolower($validate['new_name']);
        $find_category = Categorie::find($validate['id']);
        // $find_category = Categorie::where('id', $validate['id'])->first();
        if ($find_category) {
            $exit = Categorie::where('id', '!=', $find_category->id)->where('name', $credential)->where('parent_id', $find_category->parent_id)->first();
            if ($exit) {
                return response()->json([
                    'error' => 'Category already exists.'
                ], 400);
                // return redirect()->back()->with('error', 'Category already exists.');
            }
            // Update the category name
            $find_category->name = $credential;
            $find_category->save();
            return response()->json([
                'success' => 'Category updated successfully!'
            ], 200);
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }

    public function delete_category($id)
    {
        $del = Categorie::findOrFail($id);
        $del->delete();
        return redirect()->route('categories')->with('delete', 'category deleted!');
    }

    public function sub_category($id)
    {
        // if (Auth::check()) {
        $user = Auth::guard('admin')->user();
        $parent = Categorie::find($id);
        $sub_categories = Categorie::where('parent_id', $id)->where('created_by', $user->id)->paginate(5);
        return view("pages/items/sub_category", ["categories" => $sub_categories, 'parent' => $parent, 'user' => $user, 'parent_id' => $id]);
        // }
        // return redirect()->route('login');
    }

    public function add_sub_category(Request $request)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }
        $validate = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'required|integer|exists:categories,id', // Required parent
        ]);
        $cradential = strtolower($validate['name']);
        $parentId = $validate['parent_id'];
        $check = Categorie::where('name', $cradential)->where('parent_id', $parentId)->first();
        if ($check) {
            return response()->json([
                'error' => 'Subcategory already exists!'
            ], 400);
            // return redirect()->back()->with('error', 'Subcategory already exists.');
        } else {
            $category = new Categorie();
            $category->name = $cradential;
            $category->created_by = Auth::guard('admin')->id(); // Assuming you want to associate it with the user ID
            $category->parent_id = $parentId; // Set parent_id
            $category->save();
            return response()->json([
                'success' => 'Subcategory added successfully!'
            ], 200);
            // return redirect()->back()->with('success', 'Subcategory added successfully.');
        }
    }

    public function delete_sub_category($id)
    {
        $del_sub = Categorie::findOrFail($id);
        $del_sub->delete();
        return redirect()->back()->with('delete', 'subcategory deleted!');
    }
}
