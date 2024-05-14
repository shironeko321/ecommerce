<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.category.index', ['collection' => Category::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::select('id', 'name')->get();
        return view('dashboard.category.create', compact('category'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required'
        ]);

        if($request->hasFile('cover')) {
            $extension = $request->file('cover')->getClientOriginalExtension();
            $fileName = strtolower(Str::random(10) . '-' . Carbon::now()->timestamp. '.' . $extension);
            $request->file('cover')->storeAs('images', $fileName);
        } else {
            $fileName = null;
        }

        $category = ($request->category_id == "null") ? null : $request->category_id;

        Category::create([
            'name' => $data['name'],
            'cover' => $fileName,
            'category_id' => $category,
        ]);

        return redirect()->route('category.index')->with('msg', 'Success Create Category');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $category = Category::with(['category_parent'])->findOrFail($id);
        $categories = Category::all();
        return view('dashboard.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'string|required'
        ]);

        $category = Category::findOrFail($id);
        if($request->hasFile('cover')) {
            $filePath = storage_path().'/image/'. $category['cover'];
            if(Storage::exists($filePath)) {
                unlink($filePath);
            }
            $extension = $request->file('cover')->getClientOriginalExtension();
            $fileName = strtolower(Str::random(10) . '-' . Carbon::now()->timestamp. '.' . $extension);
            $request->file('cover')->storeAs('images', $fileName);
        } else {
            $fileName = $category['cover'];
        }

        $categoryId = ($request->category_id == "null")? null : $request->category_id;

        $category->update([
            'name' => $data['name'],
            'cover' => $fileName,
            'category_id' => $categoryId,
        ]);

        return redirect()->route('category.index')->with('msg', 'Success Update Category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('msg', 'Success Delete Category');
    }
}
