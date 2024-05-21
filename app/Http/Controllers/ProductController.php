<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.product.index', ['collection' => Product::paginate(10)]);
    }

    public function create()
    {
        $category = Category::all();
        return view('dashboard.product.create', compact('category'));
    }

    public function store(Request $request)
    {
        $price = str_replace( array( '\'', '"',',' , ';', '<', '>', '.' ), '', $request->price);

        $product = Product::create(([
            'name' => $request->name,
            'details' => $request->details,
            'price' => $price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id
        ]));

        foreach($request->media as $media) {
            Media::create([
                'file_name' => $media,
                'product_id' => $product->id
            ]);
        }

        if(!$request->missing('delete')) {
            foreach($request->delete as $delete) {
                Storage::delete('/public/images/'.$delete);
            }
        }

        return redirect()->route('product.index')->with('msg', 'Success Create Product');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(int $id)
    {
        $product = Product::with('media')->findOrFail($id);
        $category = Category::all();

        return view('dashboard.product.edit', compact('product', 'category'));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $price = str_replace( array( '\'', '"',',' , ';', '<', '>', '.' ), '', $request->price);
        $product->update([
            'name' => $request->name,
            'details' => $request->details,
            'price' => $price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id
        ]);

        if(!$request->missing('media')) {
            foreach($request->media as $media) {
                Media::create([
                    'file_name' => $media,
                    'product_id' => $product->id
                ]);
            }
        }

        if(!$request->missing('delete')) {
            foreach($request->delete as $delete) {
                Storage::delete('/public/images/'.$delete);
            }
        }

        return redirect()->route('product.index')->with('msg', 'Success Update Product');
    }

    public function destroy(int $id)
    {

        $product = Product::findOrFail($id);
        Media::where('product_id', $product->id)->delete();
        $product->delete();

        return redirect()->route('product.index')->with('msg', 'Success Delete Product');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('app/public/images');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $fileName = strtolower(Str::random(10) . '_' . Carbon::now()->timestamp. '_' . trim($file->getClientOriginalName()) );
        $file->move($path, $fileName);

        return response()->json([
            'name' => $fileName,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function getEditMedia(int $id)
    {
        $media = Media::findOrFail($id);
        return response()->json($media);
    }
}
