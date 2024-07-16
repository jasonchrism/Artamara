<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAuction;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(){
        $auction = ProductAuction::select('product_id')->get();
        $products = Product::with('User')->whereNotIn('product_id', $auction)->paginate(20);
        $count = Product::get()->count();
        return view('buyer.catalog', compact('products', 'count'));
    }
}
