<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReturnDetailController extends Controller
{
    public function index($order_id)
    {
        // $order_id = '9c86777e-158d-4e78-8ca1-db7602ab5aa9';
        // $order_id = '9c8dc2f9-1ac5-4d0e-9abb-e3c16186273a';
        // catatan untuk integration
        // ini ambil dulu datanya sesuai dengan order_id yang nanti akan di-pass

        $order_test = Order::with('refund')
            ->where('order_id', $order_id)
            ->get();
        // dd($order_test);

        // ini ambil status dari refund sesuai dengan ordernya
        $order_refund_status = $order_test[0]->refund->status;

        // maaf manual hehe


        $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
            ->where('order_id', $order_id)
            ->whereHas('refund', function ($query) use($order_refund_status) {
                $query->where('status', $order_refund_status);
            })
            ->get();

        $items = Order::with(['orderDetail.product.user', 'refund'])
            ->where('order_id', $order_id)
            ->whereHas('refund', function ($query) use($order_refund_status) {
                $query->where('status', $order_refund_status);
            })
            ->get();

        // if ($order_refund_status == 'ADMIN REVIEW') {
        //     $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
        //         ->where('order_id', $order_id)
        //         ->whereHas('refund', function ($query) {
        //             $query->where('status', 'ADMIN REVIEW');
        //         })
        //         ->get();

        //     $items = Order::with(['orderDetail.product.user', 'refund'])
        //         ->where('order_id', $order_id)
        //         ->whereHas('refund', function ($query) {
        //             $query->where('status', 'ADMIN REVIEW');
        //         })
        //         ->get();
        // } else if ($order_refund_status == 'ADMIN CONFIRMATION') {
        //     $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
        //         ->where('order_id', $order_id)
        //         ->whereHas('refund', function ($query) {
        //             $query->where('status', 'ADMIN CONFIRMATION');
        //         })
        //         ->get();
        //     $items = Order::with(['orderDetail.product.user', 'refund'])
        //         ->where('order_id', $order_id)
        //         ->whereHas('refund', function ($query) {
        //             $query->where('status', 'ADMIN CONFIRMATION');
        //         })
        //         ->get();
        // } else if ($order_refund_status == 'ARTIST REVIEW') {
        //     $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
        //         ->where('order_id', $order_id)
        //         ->whereHas('refund', function ($query) {
        //             $query->where('status', 'ARTIST REVIEW');
        //         })
        //         ->get();
        //     $items = Order::with(['orderDetail.product.user', 'refund'])
        //         ->where('order_id', $order_id)
        //         ->whereHas('refund', function ($query) {
        //             $query->where('status', 'ARTIST REVIEW');
        //         })
        //         ->get();
        // }

        $refund = Refund::where('order_id', $orders[0]->order_id)->first();
        $photo = null;
        $video = null;
        if ($refund && $refund->path_file) {
            $pathFileData = json_decode($refund->path_file, true);
            if (isset($pathFileData['photo'])) {
                $photo = Storage::url($pathFileData['photo']);
            }
            if (isset($pathFileData['video'])) {
                $video = Storage::url($pathFileData['video']);
            }
        }

        $photo_appeal = null;
        $video_appeal = null;
        if ($refund && $refund->path_file) {
            $pathFileData = json_decode($refund->path_file_response, true);
            if (isset($pathFileData['photo'])) {
                $photo_appeal = Storage::url($pathFileData['photo']);
            }
            if (isset($pathFileData['video'])) {
                $video_appeal = Storage::url($pathFileData['video']);
            }
        }

        return view('admin.return.returnDetail', [
            'orders' => $orders,
            'items' => $items,
            'refund_photo' => $photo,
            'refund_video' => $video,
            'refund_photo_appeal' => $photo_appeal,
            'refund_video_appeal' => $video_appeal,
        ]);
    }

    public function failuretype(Request $request, $orderId)
    {
        $data = $request->validate([
            'failure_type' => 'required|string|in:artist,shipping',
        ]);

        $refund = Refund::where('order_id', $orderId)->first();

        if ($data['failure_type'] == 'artist') {
            $refund->failure_type = 'ARTIST';
            $refund->status = 'ARTIST REVIEW';
        } else {
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
            $refund->failure_type = "ARTIST";
        } else if ($request->has('accept')) {
            $refund->failure_type = "SHIPMENT";
        }
        $refund->status = 'ACCEPTED';

        $refund->save();

        return redirect()->route('homeAdmin');
    }
    public function rejectReport($orderId){
        $refund = Refund::where('order_id', $orderId)->first();
        
        $refund->status = "REJECTED";
        
        $refund->save();

        return redirect()->route('transactions.index');
    }
}
