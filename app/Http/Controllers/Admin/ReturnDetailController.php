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
        $order_test = Order::with('refund')
            ->where('order_id', $order_id)
            ->get();
        // dd($order_test);
        $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
            ->where('order_id', $order_id)
            ->whereHas('refund', function ($query) {
                $query->where('status', 'ADMIN REVIEW');
            })
            ->get();

        // dd($orders);

        $items = Order::with(['orderDetail.product.user', 'refund'])
            ->where('order_id', $order_id)
            ->whereHas('refund', function ($query) {
                $query->where('status', 'ADMIN REVIEW');
            })
            ->get();

        return view('admin.return.returnDetail', [
            'orders' => $orders,
            'items' => $items
        ]);
    }

    public function failuretype(Request $request, $orderId)
    {
        $data = $request->validate([
            'failure_type' => 'required|string|in:artist,shipping',
        ]);

        $refund = Refund::where('order_id', $orderId)->first();

        if($data['failure_type'] == 'artist')
        {
            $refund->failure_type = 'ARTIST';
            $refund->status = 'ARTIST REVIEW';
        } else
        {
            $refund->failure_type = 'SHIPMENT';
        }

        $refund->save();

        // redirect ke tempat return kalau udah ada
        return redirect()->route('homeAdmin');
    }
}
