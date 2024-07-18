<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index($id) {
        $order = Order::with('orderDetail.product')
            ->where('order_id', $id)
            ->get();

        return view('buyer.review', [
            'order' => $order,
        ]);
    }

    public function store(Request $request) {
        $reviews = Review::query()->get();

        foreach($reviews as $r) {
            if ($r->order_id == $request->input('order_id')) {
                return redirect('/mytransactions/PACKING')->with([
                    'address_title' => 'You already submitted review',
                    'status' => 'error'
                ]);
            }
        }

        try {
            DB::beginTransaction();
            Review::create([
                'order_id' => $request->input('order_id'),
                'rating' => $request->input('rating'),
                'comment' => $request->input('review'),
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect('/mytransactions/CONFIRMED')->with('address_title', 'Review has been submitted');
    }
}
