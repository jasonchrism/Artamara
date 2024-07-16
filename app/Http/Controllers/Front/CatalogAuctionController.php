<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogAuctionController extends Controller
{
    public function index(){
        $products = Product::join('product_auctions', 'products.product_id', '=', 'product_auctions.product_id')
        ->paginate(20);
        $count = $products->count();
        return view('buyer.auction', compact('products', 'count'));
    }

    public function detail($id){
        // code here
    }
}
