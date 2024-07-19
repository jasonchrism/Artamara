<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index($id)
    {
        $order = Order::with(['orderDetail.product.user'])
            ->where('order_id', $id)
            ->first();

        $groupedProducts = $order->orderDetail->groupBy('product.user_id');
        return view('buyer.review', [
            'order' => $order,
            'groupedProducts' => $groupedProducts
        ]);
    }

    public function store(Request $request)
    {
        $review = Review::query()->get();

        foreach ($review as $r) {
            if ($r->order_id == $request->input('order_id')) {
                return redirect('/mytransactions/PACKING')->with([
                    'address_title' => 'You already submitted review',
                    'status' => 'error'
                ]);
            }
        }

        $reviews = $request->input('reviews');

        foreach ($reviews as $review) {
            try {
                DB::beginTransaction();
                Review::create([
                    'order_id' => $review['order_id'],
                    'artist_id' => $review['artist_id'],
                    'rating' => $review['rating'],
                    'comment' => $review['comment'],
                ]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        }

        return redirect('/mytransactions/CONFIRMED')->with('address_title', 'Review has been submitted');
    }
}
