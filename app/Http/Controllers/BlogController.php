<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index' , compact('blogs'));
    }

        public function createUpdate($id = null)
    {
        $blogs = Blog::find($id);
        return view('admin.blogs.form', compact('blogs'));
    }

public function store(Request $request)
{
    $request->validate([
        'event_name' => 'required|string|max:255',
        'event_date' => 'required|date',
        'banner_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'video' => 'required|mimes:mp4,mov,avi,wmv|max:10000',
        'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->only(['event_name', 'event_date']);

    // banner_img upload
    if ($request->hasFile('banner_img')) {
        $file = $request->file('banner_img');
        $extension = $file->getClientOriginalExtension();
        $filename = 'banner_' . time() . '.' . $extension;
        $file->move(public_path('uploads/blogs/'), $filename);
        $data['banner_img'] = 'uploads/blogs/' . $filename;
    }

    // video upload
    if ($request->hasFile('video')) {
        $file = $request->file('video');
        $extension = $file->getClientOriginalExtension();
        $filename = 'video_' . time() . '.' . $extension;
        $file->move(public_path('uploads/blogs/'), $filename);
        $data['video'] = 'uploads/blogs/' . $filename;
    }

    // img upload
    if ($request->hasFile('img')) {
        $file = $request->file('img');
        $extension = $file->getClientOriginalExtension();
        $filename = 'img_' . time() . '.' . $extension;
        $file->move(public_path('uploads/blogs/'), $filename);
        $data['img'] = 'uploads/blogs/' . $filename;
    }

    Blog::updateOrCreate(['id' => $request->id], $data);

    return redirect()->route('blog.index')->with('success', 'Blog saved successfully!');
}
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blog.index')->with('success', "blog delete successfully.");
    }


}
