<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(){
        $products = Product::with('User')->paginate(20);
        $count = Product::get()->count();
        return view('buyer.catalog', compact('products', 'count'));
    }
}
