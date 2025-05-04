<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function show($id)
    {
        $orders = Order::where('id', $id)->get();

        if ($orders->isEmpty()) {
            return redirect()->route('admin.orders')->with('error', 'Order not found.');
        }

        $product = Product::find($orders->first()->product_id);
        return view('admin.orderDetails', compact('orders', 'product'));
    }
}

