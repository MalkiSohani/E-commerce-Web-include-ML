<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::getData(true);
        $products = $query->paginate(20);
        $latestProducts = $query->orderby('created_at', 'DESC')->limit(3)->get();
        return view('welcome', compact(['products', 'latestProducts']));
    }
}
