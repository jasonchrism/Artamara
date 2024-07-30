<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAuction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyBidsController extends Controller
{
    public function index(Request $request, $status)
{
    $user_id = Auth::id();

    // Fetch products where the user has placed bids
    $products = Product::whereHas('productAuction.bid', function ($query) use ($user_id, $status) {
        $query->where('user_id', $user_id);
        if ($status == 'ON GOING') {
            $query->where('status', 'ON GOING');
        } else {
            $query->whereIn('status', ['CLOSED', 'PAID']);
        }
    })->with(['productAuction' => function ($query) use ($user_id) {
        $query->with(['bid' => function ($query) use ($user_id) {
            $query->orderBy('created_at', 'desc');
        }]);
    }, 'user'])->get();

    // Prepare the data for the view
    $productsWithBids = $products->map(function ($product) use ($user_id) {
        $productAuction = $product->productAuction;
        $userLastBid = $productAuction->bid->where('user_id', $user_id)->first();
        $latestBid = $productAuction->bid->first();

        // Calculate price multiples for each auction
        $buyNow = $productAuction->product->price;
        $startPrice = $productAuction->start_price;
        $baseMultiple = $productAuction->add_price;
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

        return [
            'product' => $product,
            'user_last_bid' => $userLastBid,
            'latest_bid' => $latestBid,
            'priceMultiples' => $priceMultiples,
        ];
    });

    return view('buyer.myBids', ['productsWithBids' => $productsWithBids, 'status' => $status]);
}

}
