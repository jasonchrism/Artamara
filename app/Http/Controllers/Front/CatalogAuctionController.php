<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAuction;
use Illuminate\Http\Request;

class CatalogAuctionController extends Controller
{
    public function index(){
        $products = Product::join('product_auctions', 'products.product_id', '=', 'product_auctions.product_id')
        ->paginate(20);
        $count = $products->count();
        return view('buyer.auction', compact('products', 'count'));
    }

    public function category($category){
        $categoryDetail = Category::where('name', '=', $category)->first();

        $categoryId = Category::where('name', '=', $category)->pluck('category_id')->first();
        $products = Product::join('product_auctions', 'products.product_id', '=', 'product_auctions.product_id')
        ->where('products.category_id', '=', $categoryId)->paginate(20);
        $count = $products->count();
        return view('buyer.categoryAuction', compact('products', 'count', 'categoryDetail'));
    }

    public function detail($id){
        // code here
    }
}
