<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnDetailController extends Controller
{
    public function index() {
        // $order_id = '9c86777e-158d-4e78-8ca1-db7602ab5aa9';
        $order_id = '9c8dc2f9-1ac5-4d0e-9abb-e3c16186273a';
        $order_test = Order::where('order_id', $order_id);
        $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
            ->where('order_id', $order_id)
            ->where('status', 'ADMIN REVIEW')
            ->get();

        $items = Order::with(['orderDetail.product.user'])
            ->where('order_id', $order_id)
            ->where('status', 'ADMIN REVIEW')
            ->get();

        return view('admin.return.returnDetail', [
            'orders' => $orders,
            'items' => $items
        ]);
    }
}
