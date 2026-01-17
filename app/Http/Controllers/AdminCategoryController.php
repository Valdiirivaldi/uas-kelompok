<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'slug' => 'required|unique:categories',
            'image' => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('category-images');
        }

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'New category has been added!');
    }

// Pastikan parameter di dalam kurung adalah (Category $category)
public function edit(Category $category)
{
    return view('dashboard.categories.edit', [
        'category' => $category
    ]);
}

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
            'image' => 'image|file|max:1024'
        ];

        if($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('category-images');
        }

        Category::where('id', $category->id)->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category has been updated!');
    }

    public function destroy(Category $category)
    {
        if($category->image) {
            Storage::delete($category->image);
        }
        
        Category::destroy($category->id);
        return redirect('/dashboard/categories')->with('success', 'Category has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->name);
        return response()->json(['slug' => $slug]);
    }
}