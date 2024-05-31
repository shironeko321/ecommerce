<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'product' => Product::all(),
            'category' => Category::all()
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->validate([
            'search' => 'required|string'
        ])['search'];

        $product = Product::with('category')->where('name', 'like', "%$search%")->get();
        $category = Category::with('category_children')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->where('products.name', 'like', "%$search%")
            ->distinct()
            ->get(['categories.*']);

        return view('home.search', [
            'product' => $product,
            'category' => $category,
        ]);
    }

    public function category(Category $category)
    {
        $product = Product::where('category_id', $category->id)->get();
        $category = $category::with('category_children')->get();

        return view('home.search', [
            'product' => $product,
            'category' => $category,
        ]);
    }

    public function detail(Product $product)
    {
        $product = $product->with(['category', 'media'])->where('id', $product->id)->first();
        // dd($product);

        return view('home.detail', ['product' => $product]);
    }
}
