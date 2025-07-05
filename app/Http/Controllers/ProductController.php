<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class ProductController extends Controller
{
    // Create / Edit Form
    public function createUpdate($id = null)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.product.form', compact('product', 'categories', 'subcategories'));
    }

public function store(Request $request)
{
    $product = Product::find($request->id);

    $rules = [
        'title' => 'required|string|max:255',
        'best_selling' => 'required|boolean',
        'features' => 'required|string',
        'specification' => 'required|string',
        'description' => 'required|string',

        'category_1_id' => 'required|integer',
        'category_2_id' => 'required|integer',
        'category_3_id' => 'required|integer',
        'category_4_id' => 'required|integer',
        'category_5_id' => 'required|integer',

        'subcategory_1_id' => 'required|integer',
        'subcategory_2_id' => 'required|integer',
        'subcategory_3_id' => 'required|integer',
        'subcategory_4_id' => 'required|integer',
        'subcategory_5_id' => 'required|integer',
    ];

    if (!$product) {
        $rules['img_1'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
    }

    $rules['img_1'] = $rules['img_1'] ?? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
    $rules['img_2'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
    $rules['img_3'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
    $rules['img_4'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
    $rules['img_5'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';

    $request->validate($rules);

    $product = $product ?: new Product();
    $msg = $product->exists ? 'updated' : 'created';

    $product->title = $request->title;
    $product->best_selling = $request->best_selling;

    // ✅ Individual image uploads
    if ($request->hasFile('img_1')) {
        $file = $request->file('img_1');
        $filename = time() . '_1.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/products/'), $filename);
        $product->img_1 = 'uploads/products/' . $filename;
    }

    if ($request->hasFile('img_2')) {
        $file = $request->file('img_2');
        $filename = time() . '_2.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/products/'), $filename);
        $product->img_2 = 'uploads/products/' . $filename;
    }

    if ($request->hasFile('img_3')) {
        $file = $request->file('img_3');
        $filename = time() . '_3.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/products/'), $filename);
        $product->img_3 = 'uploads/products/' . $filename;
    }

    if ($request->hasFile('img_4')) {
        $file = $request->file('img_4');
        $filename = time() . '_4.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/products/'), $filename);
        $product->img_4 = 'uploads/products/' . $filename;
    }

    if ($request->hasFile('img_5')) {
        $file = $request->file('img_5');
        $filename = time() . '_5.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/products/'), $filename);
        $product->img_5 = 'uploads/products/' . $filename;
    }

    // ✅ Category & Subcategory (no loop)
    $product->category_1_id = $request->category_1_id;
    $product->category_2_id = $request->category_2_id;
    $product->category_3_id = $request->category_3_id;
    $product->category_4_id = $request->category_4_id;
    $product->category_5_id = $request->category_5_id;

    $product->subcategory_1_id = $request->subcategory_1_id;
    $product->subcategory_2_id = $request->subcategory_2_id;
    $product->subcategory_3_id = $request->subcategory_3_id;
    $product->subcategory_4_id = $request->subcategory_4_id;
    $product->subcategory_5_id = $request->subcategory_5_id;

    $product->features = $request->features;
    $product->specification = $request->specification;
    $product->description = $request->description;

    $product->save();

    return redirect()->route('product.index')->with('success', "Product {$msg} successfully.");
}

    // List All Products
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    // Delete (optional)
// public function delete($id)
// {
//     $product = Product::findOrFail($id);
//     $product->delete();
//     return redirect()->back()->with('success', 'Product deleted successfully.');
// }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', "Product delete successfully.");
    }

}

