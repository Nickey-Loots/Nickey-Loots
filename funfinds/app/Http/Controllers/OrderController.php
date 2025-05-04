<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->where('user_id', Auth::id())
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('orders.*', 'products.name', 'products.image')
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }
}
