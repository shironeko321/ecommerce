<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;

        // relasi cart ke product ke media
        $cart = Cart::with('product.media')->where('user_id', $userId)->get();

        return view('home.cart', ['cart' => $cart]);
    }

    public function store(Request $request, int $product)
    {
        //ambil jumlah yang dibeli
        $quantity = $request->validate([
            'quantity' => 'required|numeric'
        ])['quantity'];

        $userId = Auth::user()->id;
        $product = Product::find($product)->first();

        // param 1 cari kalau tidak ketemu buat baru
        Cart::updateOrCreate([
            'product_id' => $product->id,
            'user_id' => $userId
        ], [
            'product_id' => $product->id,
            'user_id' => $userId,
            'quantity' => $quantity,
        ]);

        return redirect()->back();
    }
}
