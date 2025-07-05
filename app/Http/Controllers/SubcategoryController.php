<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\SubCategory as ModelsSubCategory;

class SubcategoryController extends Controller
{
    // Create / Update Form
    public function createUpdate($id = null)
    {
        $subcategory = Subcategory::find($id);
        $categories = Category::all();
        return view('admin.subcategory.form', compact('subcategory', 'categories'));
    }

    // Store (Add / Update)
public function store(Request $request)
{
    $subcategory = Subcategory::find($request->id);

    $rules = [
        'name' => 'required|unique:subcategories,name,' . ($request->id ?? 'null') . ',id',
        'category_id' => 'required',
    ];

    // Add required image validation only when creating
    if (!$subcategory) {
        $rules['img'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
    }

    $messages = [
        'name.required' => 'Subcategory name is required.',
        'name.unique' => 'This subcategory name already exists.',
        'category_id.required' => 'Please select a category.',
        'img.required' => 'Image is required.',
        'img.image' => 'The file must be an image.',
        'img.mimes' => 'Allowed image types: jpeg, png, jpg, gif.',
        'img.max' => 'Image size must be less than 2MB.',
    ];

    $request->validate($rules, $messages);

    if ($subcategory) {
        $msg = 'updated';
    } else {
        $subcategory = new Subcategory();
        $msg = 'created';
    }

    $subcategory->name = $request->name;
    $subcategory->category_id = $request->category_id;

    if ($request->file('img')) {
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/subcategory/'), $filename);
        $subcategory->img = 'uploads/subcategory/' . $filename;
    }

    $subcategory->save();

return redirect()->route('subcategory.index')->with('success', "Subcategory {$msg} successfully.");
}

    // List All Subcategories
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    // Delete
    public function delete($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        // return redirect()->back()->with('success', 'Subcategory deleted successfully.');

            return redirect()->route('subcategory.index')->with('success', "Subcategory delete successfully.");

        
    }
}
