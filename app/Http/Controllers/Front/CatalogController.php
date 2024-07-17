<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAuction;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(){
        $auction = ProductAuction::select('product_id')->get();
        $products = Product::with('User')->whereNotIn('product_id', $auction)->paginate(20);
        $count = $products->count();
        return view('buyer.catalog', compact('products', 'count'));
    }

    public function category($category){
        $categoryDetail = Category::where('name', '=', $category)->first();

        $categoryId = Category::where('name', '=', $category)->pluck('category_id')->first();
        $auction = ProductAuction::select('product_id')->get();
        $products = Product::with('User')->whereNotIn('product_id', $auction)->where('category_id', '=', $categoryId)->paginate(20);
        $count = $products->count();
        return view('buyer.categoryProduct', compact('products', 'count', 'categoryDetail'));
    }
}
