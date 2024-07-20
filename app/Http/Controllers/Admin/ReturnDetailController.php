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
        // catatan untuk integration
        // ini ambil dulu datanya sesuai dengan order_id yang nanti akan di-pass

        $order_test = Order::with('refund')
            ->where('order_id', $order_id)
            ->get();
        // dd($order_test);

        // ini ambil status dari refund sesuai dengan ordernya
        $order_refund_status = $order_test[0]->refund->status;

        // maaf manual hehe

        if($order_refund_status == 'ADMIN REVIEW')
        {
            $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
                ->where('order_id', $order_id)
                ->whereHas('refund', function ($query) {
                    $query->where('status', 'ADMIN REVIEW');
                })
                ->get();

            $items = Order::with(['orderDetail.product.user', 'refund'])
                ->where('order_id', $order_id)
                ->whereHas('refund', function ($query) {
                    $query->where('status', 'ADMIN REVIEW');
                })
                ->get();


        } else if ($order_refund_status == 'ADMIN CONFIRMATION') {
            $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
                ->where('order_id', $order_id)
                ->whereHas('refund', function ($query) {
                    $query->where('status', 'ADMIN CONFIRMATION');
                })
                ->get();
            $items = Order::with(['orderDetail.product.user', 'refund'])
                ->where('order_id', $order_id)
                ->whereHas('refund', function ($query) {
                    $query->where('status', 'ADMIN CONFIRMATION');
                })
                ->get();
        }




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
            $refund->status = 'ACCEPTED';
        }

        $refund->save();

        // redirect ke tempat return kalau udah ada
        return redirect()->route('homeAdmin');
    }

    public function confirmationAppeal(Request $request, $orderId)
    {
        $refund = Refund::where('order_id', $orderId)->first();
        if ($request->has('reject')) {
            $refund->status = 'REJECTED';
        } else if ($request->has('accept')) {
            $refund->status = 'ACCEPTED';
        }

        $refund->save();

        return redirect()->route('homeAdmin');
    }
}
