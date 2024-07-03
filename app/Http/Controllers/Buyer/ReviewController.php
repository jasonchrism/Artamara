<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index() {

        $order = Order::all();
        return view('buyer.review');
    }
}
