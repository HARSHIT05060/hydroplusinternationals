<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Add/Edit Form
    public function createUpdate($id = null)
    {
        $category = Category::find($id);
        $data['category'] = $category ?? null;

        return view('admin.category.form', $data);
    }

    // Add/Update Logic in same store function
public function store(Request $request, $id = null)
{
    $category = Category::find($request->id); // check if updating

    if ($category) {
        // ✅ Update Case - image not required
        $request->validate([
            'name' => 'required|unique:categories,name,' . $request->id,
        ], [
            'name.required' => 'Category name is required.',
            'name.unique' => 'This category name already exists.',
        ]);

        if ($request->file('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/category/'), $filename);
            $category->img = 'uploads/category/' . $filename;
        }

        $category->name = $request->name;
        $category->save();
        $message = 'updated';
    } else {
        // ✅ Store Case - image is required
        $request->validate([
            'name' => 'required|unique:categories,name',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Category name is required.',
            'name.unique' => 'This category name already exists.',
            'img.required' => 'Category image is required.',
            'img.image' => 'The uploaded file must be an image.',
            'img.mimes' => 'Only jpeg, png, jpg, gif formats are allowed.',
            'img.max' => 'Image size should not be more than 2MB.',
        ]);

        $category = new Category();
        $category->name = $request->name;

        $file = $request->file('img');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path('uploads/category/'), $filename);
        $category->img = 'uploads/category/' . $filename;

        $category->save();
        $message = 'created';
    }

    return redirect()->route('category.index')->with('success', 'Category ' . $message . ' successfully.');
}

    // List
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    // Delete
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // return redirect()->back()->with('success', 'Category deleted successfully.');

        return redirect()->route('category.index')->with('success', "Category delete successfully.");
    }
}
