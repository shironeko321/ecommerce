<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $userId = Auth::user()->id;

    public function index()
    {
        $cart = Cart::where('user_id', $this->userId)->get();

        return view('dashboard.forntend.cart.index', compact('cart'));
    }
    public function store(Request $request, int $cartId)
    {
        //ambil jumlah yang dibeli
        $quantity = $request->quantity;

        // $userId = Auth::user()->id;
        $cart = Cart::where('product_id', $cartId)->first();

        if ($this->userId == $cart['user_id'] && $cartId == $cart['product_id']) {
            $quantity += $cart['quantity'];

            $cart->update([
                'quantity' => $quantity
            ]);
        } else {
            Cart::create([
                'quantity' => $quantity,
                'product_id' => $cart,
                'user_id' => $this->userId
            ]);
        }

        return redirect()->refresh();

    }

}
