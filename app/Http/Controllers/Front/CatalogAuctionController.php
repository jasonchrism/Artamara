<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Bid;
use App\Models\Product;
use App\Models\ProductAuction;
use Illuminate\Http\Request;

class CatalogAuctionController extends Controller
{
    public function index()
    {
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

    public function detail($id)
    {
        // mencari product sesuai id yang diterima pada database
        $product = ProductAuction::with('product')->where('product_id', $id)->first();
        $lastBid = Bid::where('product_id', $id)->orderBy('bid_price', 'desc')->first();
        // dd($auctions);

        $baseMultiple = $product->add_price;
        $maxMultiple = 20;
        $priceMultiples = [];
        for ($i = 1; $i <= $maxMultiple; $i++) {
            $priceMultiples[] = $baseMultiple * $i;
        }

        $bids = Bid::with('user')->where('product_id', $id)->get();
        // dd($bids);
        return view('buyer.auctionDetails', compact('product', 'lastBid' , 'priceMultiples' , 'bids'));
    }

    public function updateStatus(Request $request)
    {
        $productId = $request->input('product_id');
        $status = $request->input('status');

        $auction = ProductAuction::where('product_id', $productId)->first();
        if ($auction) {
            $auction->status = $status;
            $auction->save();
            return response()->json(['message' => 'Status updated successfully']);
        }

        return response()->json(['message' => 'Auction not found'], 404);
    }
}
