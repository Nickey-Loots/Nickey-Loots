<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // dd('HomeController werkt');

        $products = Product::all();

        return view('home', compact('products'));
    }
}
