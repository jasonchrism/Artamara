<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReturnDetailController extends Controller
{
    public function index($order_id, $status) {
        // $order_id = '9c86777e-158d-4e78-8ca1-db7602ab5aa9';
        // $order_id = '9c8dc2f9-1ac5-4d0e-9abb-e3c16186273a';

        // dd($order_id);
        $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod', 'refund'])
            ->where('order_id', $order_id)
            ->whereHas('refund', function ($query) use($status) {
                $query->where('status', $status);
            })
            ->get();
        
        $items = Order::with(['orderDetail.product.user', 'refund'])
            ->where('order_id', $order_id)
            ->whereHas('refund', function ($query) use($status){
                $query->where('status', $status);
            })
            ->get();

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

        return view('artist.return.returnDetail', [
            'orders' => $orders,
            'items' => $items,
            'refund_photo' => $photo,
            'refund_video' => $video,
            'status' => $status
        ]);
    }

    public function appeal(Request $request, $orderId) {

        $data = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'required|mimes:mp4|max:51200',
            'description' => 'required|string|min:3|max:200',
        ]);

        // dd($data['description']);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('storage/photos', 'public');
        }


        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoPath = $video->store('storage/videos', 'public');
        }

        $path_file_response = json_encode(['photo' => $photoPath, 'video' => $videoPath]);

        $refund = Refund::where('order_id', $orderId)->first();
        $refund->path_file_response = $path_file_response;
        $refund->status = 'ADMIN CONFIRMATION';
        $refund->response = $data['description'];
        $refund->save();


        return redirect('/dashboard/artist/home');
    }
}
