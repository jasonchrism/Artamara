<?php

namespace App\Http\Controllers\Front;

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

    public function category($category)
    {
        $categoryDetail = Category::where('name', '=', $category)->first();

        $categoryId = Category::where('name', '=', $category)->pluck('category_id')->first();
        $products = Product::join('product_auctions', 'products.product_id', '=', 'product_auctions.product_id')
            ->where('products.category_id', '=', $categoryId)->paginate(20);
        $count = $products->count();
        return view('buyer.categoryAuction', compact('products', 'count', 'categoryDetail'));
    }

    public function detail($id)
    {
        // Find the product by ID with related product details
        $product = ProductAuction::with('product')->where('product_id', $id)->first();
        $lastBid = Bid::where('product_id', $id)->orderBy('bid_price', 'desc')->first();

        $buyNow = $product->product->price;
        $startPrice = $product->start_price;
        $baseMultiple = $product->add_price;
        $maxMultiple = 20;
        $priceMultiples = [];

        // Initialize with the start price
        $currentPrice = $startPrice;
        $priceMultiples[] = $currentPrice;

        // Calculate the price multiples starting from startPrice and adding baseMultiple
        while (true) {
            $currentPrice += $baseMultiple;
            if ($currentPrice >= $buyNow) {
                break; // Exit loop if currentPrice is greater than or equal to buyNow
            }
            $priceMultiples[] = $currentPrice;
        }

        $bids = Bid::with('user')->where('product_id', $id)->orderBy('created_at', 'desc')->get();
        $bids = $bids->isEmpty() ? null : $bids;

        return view('buyer.auctionDetails', compact('product', 'lastBid', 'priceMultiples', 'bids'));
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
