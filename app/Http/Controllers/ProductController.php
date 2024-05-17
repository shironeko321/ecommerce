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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('dashboard.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->missing('delete')) {
            foreach($request->delete as $delete) {
                $filePath = storage_path().'/images/'. $delete;
                Storage::delete('/public/images/'.$delete);
                dd($filePath);
                // if(Storage::exists($filePath)) {
                //     Storage::delete($filePath);
                // }
            }
        }
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

        if ($request->input('delete')) {
            foreach($request->delete as $delete) {
                $filePath = storage_path().'/images/'. $delete;
                if(Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            }
        }

        return redirect()->route('product.index')->with('msg', 'Success Create Product');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('app/images');

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
    //     $path = storage_path('app/images');

    // if (!file_exists($path)) {
    //     mkdir($path, 0777, true);
    // }

    // $file = $request->file('file');

    // $name = uniqid() . '_' . trim($file->getClientOriginalName());

    // $file->move($path, $name);

    // return response()->json([
    //     'name'          => $name,
    //     'original_name' => $file->getClientOriginalName(),
    // ]);
    }
}
