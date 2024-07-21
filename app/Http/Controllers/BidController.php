<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'bid_price' => 'required|integer|min:1',
        ]);

        $product_id = $request->input('product_id');
        $bid_price = $request->input('bid_price');
        $user_id = Auth::id();
        // dd($user_id);

        // Get the current highest bid price for the product
        $highestBid = Bid::where('product_id', $product_id)
            ->orderBy('bid_price', 'desc')
            ->first();

        // Check if the new bid price is greater than the current highest bid price
        if ($highestBid && $bid_price <= $highestBid->bid_price) {
            return back()->withErrors(['bid_price' => 'The bid price must be higher than the current highest bid price.']);
        }

        // Use a transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // Lock the table to prevent race conditions
            $existingBid = Bid::where('product_id', $product_id)
                ->where('bid_price', $bid_price)
                ->lockForUpdate()
                ->first();

            if ($existingBid) {
                DB::rollBack();
                return back()->withErrors(['bid_price' => 'This bid price has already been placed.']);
            }

            // Create the new bid
            Bid::create([
                'product_id' => $product_id,
                'user_id' => Auth::id(),
                'bid_price' => $bid_price,
            ]);

            DB::commit();

            return back()->with('success', 'Bid placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while placing your bid. Please try again.']);
        }
    }
}
