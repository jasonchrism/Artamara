<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAuction;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $auction = ProductAuction::select('product_id')->get();
        $products = Product::with('User')->whereNotIn('product_id', $auction)->paginate(5);
        $auctions = Product::join('product_auctions', 'products.product_id', '=', 'product_auctions.product_id')
            ->paginate(5);
        return view('landing', [
            'products' => $products,
            'auctions' => $auctions
        ]);
    }
}
