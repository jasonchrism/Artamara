<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index() {
        $order = Order::with('orderDetail.product')
            ->where('order_id', '0b7ebf1a-3e62-11ef-84b4-005056c00001')
            ->get();


        return view('buyer.review', [
            'order' => $order,
        ]);
    }

    public function store(Request $request) {
        $rating = $request->input('rating');
        $comment = $request->input('review');

        dd($request->input('order_id'));
    }
}
