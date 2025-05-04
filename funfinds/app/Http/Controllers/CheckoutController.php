<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $cartItems = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select('cart.*', 'products.name', 'products.image')
            ->where('cart.user_id', Auth::id())
            ->get();

        $grandTotal = $cartItems->sum(fn($item) => $item->price * $item->qty);

        return view('checkout', compact('cartItems', 'grandTotal'));

    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'number' => 'required|string|max:20',
            'flat' => 'required|string|max:100',
            'city' => 'required|string|max:100',
        ]);

        $userId = Auth::id();
        $address = "{$request->flat}, {$request->city}";

        $cartItems = DB::table('cart')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $userId,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->price,
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'address' => $address,
                'status' => 'pending',
            ]);
        }

        DB::table('cart')->where('user_id', $userId)->delete();

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

}

