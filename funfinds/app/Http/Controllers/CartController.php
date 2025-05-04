<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $cartItems = DB::table('cart')
            ->where('user_id', $userId)
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select('cart.*', 'products.name', 'products.image')
            ->get();

        return view('cart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1|max:99',
        ]);

        DB::table('cart')->insert([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'price' => DB::table('products')->where('id', $request->product_id)->value('price'),
            'qty' => $request->qty,
        ]);

        return redirect()->back()->with('success', 'Product added to cart.');
    }


    public function update(Request $request)
    {
        DB::table('cart')
            ->where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->update(['qty' => $request->qty]);

        return back();
    }

    public function destroy(Request $request)
    {
        DB::table('cart')
            ->where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->delete();

        return back();
    }

    public function empty()
    {
        DB::table('cart')
            ->where('user_id', Auth::id())
            ->delete();

        return back();
    }
}