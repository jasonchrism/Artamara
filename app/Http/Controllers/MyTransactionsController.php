<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyerReportRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Refund;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $status)
    {
        // DOCUMENTATION!!

        $user_id = Auth::id(); //ini ambil id dari user buyer

        // ambil order_id yang di mana order-nya masuk ke payment untuk cek status
        // dari payment, ambil payment status
        // untuk cek apakah order ini sudah di bayar atau belum
        // order ID diambil yang sesuai kriteria ke dalam suatu array

        // masih manual, bisa di-improve but we can do it later
        if ($status == 'UNPAID') {
        $order_ids = Order::where('user_id', $user_id)->with('payment')
                ->whereHas('payment', function ($query) {
                    $query->where('status', 'UNPAID');
                })
                ->pluck('order_id')
                ->toArray();
        }
        if ($status == 'PACKING') {
            $order_ids = Order::where('user_id', $user_id)->with('payment')
                ->whereHas('payment', function ($query) {
                    $query->where('status', 'PAID');
                })
                ->where('status', 'PACKING')
                ->pluck('order_id')
                ->toArray();
        }
        if ($status == 'SHIPPING') {
            $order_ids = Order::where('user_id', $user_id)
                ->whereIn('status',  [$status, 'DELIVERED'])
                ->pluck('order_id')
                ->toArray();
        }
        if ($status == 'CONFIRMED') {
            $order_ids = Order::where('user_id', $user_id)
                ->where('status', $status)
                ->pluck('order_id')
                ->toArray();
        }
        if ($status == 'RETURNED') {
            $order_ids = Order::where('user_id', $user_id)
                ->where('status', $status)
                ->pluck('order_id')
                ->toArray();
        }
        if ($status == 'CANCELLED') {
            $order_ids = Order::where('user_id', $user_id)
                ->where('status', $status)
                ->pluck('order_id')
                ->toArray();
        }

        // dd($order_ids);
        // sampai order_ids sudah aman, hanya satu data





        // ini ngambil semua product dari table orderdetail
        // di mana dari orderdetail akan dicek order_id nya
        // kalau ketemu, gabung table dengan table order dari orderDetail
        // terus gabungin juga sama table user
        // cari yang sesuai dengan user_id nya aja, jadi productnya di group sesuai user_id yang sama
        $products = Product::whereHas('orderDetail', function ($query) use ($order_ids) {
            $query->whereIn('order_id', $order_ids);
        })
            ->with(['orderDetail.order', 'user'])
            ->orderBy('user_id') // Assuming user_id is the artist's id
            ->get();


        // dd($products);
        // sampai products sudah bener, hanya 1 array dengan 2 array products di dalamnya

        // ini array baru
        $groupedProducts = [];



        // ini foreach untuk semua product

        if($status != 'RETURNED')
        {

            foreach ($products as $product) {

                // dd($product);


                // ini nambahin table order detail ke product

                foreach ($product->orderDetail as $orderDetail) {
                    // dd($orderDetail->order_id , $order_ids[0]);
                    if (!in_array($orderDetail->order_id, $order_ids)) {
                        continue;
                    }

                    $address_ID = Order::with('userAddress')
                        ->where('order_id', $orderDetail->order_id)
                        ->pluck('address_id')
                        ->first();

                    // dd($address_ID);

                    $address = Address::where('address_id', $address_ID)
                        ->first();
                    // dd($address);

                    $payment_id = Order::where('order_id', $orderDetail->order_id)->pluck('payment_id')->first();
                    // dd($payment_id);

                    $paymentmethod_id = Payment::with('PaymentMethod')
                        ->where('payment_id', $payment_id)
                        ->pluck('payment_method_id')
                        ->first();
                    // dd($address);

                    $payment_method = PaymentMethod::where('payment_method_id', $paymentmethod_id)->pluck('name')->first();
                    // dd($payment_method);
                    $orderDetails = Order::where('order_id', $orderDetail->order_id)->first();

                    // ini orderID yang diambil dari orderDetail di table order
                    $orderId = $orderDetail->order->order_id;
                    // dd($orderId);


                    $total = $orderDetail->order->total_price;
                    $shipment = $orderDetail->order->shipment_fee;
                    $grand_total = $total + $shipment;
                    // dd($grand_total);
                    // ini ambil user id sesuai dari product yang dicek
                    $artistId = $product->user_id; // Assuming user_id is the artist's ID

                    // ini ambil tanggalnya
                    $createdAt = $orderDetail->order->created_at;
                    $updatedAt = $orderDetail->order->updated_at;
                    $orderstatus = $orderDetail->order->status;

                    $paymentMax = Carbon::parse($createdAt)->addHours(24);
                    $estimatedArrival = Carbon::parse($updatedAt)->addHours(72);

                    // ini cek apakah order id (array sekian) sudah ada di array grouped
                    // kalau belum ada, dibikin dan dikasih array baru di dalamnya
                    // isinya created at dan artist
                    if (!isset($groupedProducts[$orderId])) {
                        $groupedProducts[$orderId] = [
                            'created_at' => $createdAt,
                            'payment_max' => $paymentMax,
                            'orderstatus' => $orderstatus,
                            'buyer_address' => $address,
                            'payment_method' => $payment_method,
                            'grand_total' => $grand_total,
                            'estimated_arrival' => $estimatedArrival,
                            'artists' => [],
                            'orderDetails' => $orderDetails
                        ];
                    }

                    // di sini tuh cek orderid sekian dari dari array groupedproducts
                    // nah, cek apakah di array artists, cek apakah ada index dari artistID
                    // kalau belum, bikin array lagi di dalam artist untuk index itu
                    if (!isset($groupedProducts[$orderId]['artists'][$artistId])) {
                        $groupedProducts[$orderId]['artists'][$artistId] = [];
                    }

                    // nah, ini product-nya, isi dari tralala itu
                    $groupedProducts[$orderId]['artists'][$artistId][] = $product;
                }
            }
        } else
        {
            foreach ($products as $product) {

                foreach ($product->orderDetail as $orderDetail) {

                    if (!in_array($orderDetail->order_id, $order_ids)) {
                        continue;
                    }

                    $address_ID = Order::with('userAddress')
                        ->where('order_id', $orderDetail->order_id)
                        ->pluck('address_id')
                        ->first();



                    $address = Address::where('address_id', $address_ID)
                        ->first();


                    $payment_id = Order::where('order_id', $orderDetail->order_id)->pluck('payment_id')->first();

                    $paymentmethod_id = Payment::with('PaymentMethod')
                        ->where('payment_id', $payment_id)
                        ->pluck('payment_method_id')
                        ->first();


                    $payment_method = PaymentMethod::where('payment_method_id', $paymentmethod_id)->pluck('name')->first();

                    $orderId = $orderDetail->order->order_id;



                    $total = $orderDetail->order->total_price;
                    $shipment = $orderDetail->order->shipment_fee;
                    $grand_total = $total + $shipment;

                    $artistId = $product->user_id;

                    $createdAt = $orderDetail->order->created_at;
                    $updatedAt = $orderDetail->order->updated_at;
                    $orderstatus = $orderDetail->order->status;

                    $paymentMax = Carbon::parse($createdAt)->addHours(24);
                    $estimatedArrival = Carbon::parse($updatedAt)->addHours(72);

                    // hubungin dengan table refund
                    $refund_status = Refund::where('order_id', $orderDetail->order_id)->pluck('status')
                    ->first();

                    $refund = Refund::where('order_id', $orderDetail->order_id)->first();
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


                    if (!isset($groupedProducts[$orderId])) {
                        $groupedProducts[$orderId] = [
                            'created_at' => $createdAt,
                            'payment_max' => $paymentMax,
                            'orderstatus' => $orderstatus,
                            'buyer_address' => $address,
                            'payment_method' => $payment_method,
                            'grand_total' => $grand_total,
                            'estimated_arrival' => $estimatedArrival,
                            'refund_status' => $refund_status,
                            'refund' => $refund,
                            'refund_photo' => $photo,
                            'refund_video' => $video,
                            'artists' => []
                        ];
                    }

                    if (!isset($groupedProducts[$orderId]['artists'][$artistId])) {
                        $groupedProducts[$orderId]['artists'][$artistId] = [];
                    }


                    $groupedProducts[$orderId]['artists'][$artistId][] = $product;
                }
            }
        }

        // Debugging output
        // dd($groupedProducts);


        // =================================== NEWEST





        return view('buyer.mytransactions', compact('groupedProducts', 'status'));
    }

    public function confirmation(Request $request, $status, $orderId)
    {
        $order = Order::find($orderId);
        $order->status = 'CONFIRMED';
        $order->save();

        return redirect()->action([MyTransactionsController::class, 'index'], ['status' => $status]);

    }

    public function report(BuyerReportRequest $request, $status, $orderId)
    {
        $data = $request->all();
        // dd($data);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('storage/photos', 'public');
        }

        // Simpan video
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoPath = $video->store('storage/videos', 'public');
        }

        // Simpan jalur file dalam satu kolom
        $path_file = json_encode(['photo' => $photoPath, 'video' => $videoPath]);

        $data['order_id'] = $orderId;
        $data['path_file'] = $path_file;
        $data['status'] = 'ADMIN REVIEW';
        // dd($data);
        Refund::create($data);

        $order = Order::find($orderId);
        $order->status = 'RETURNED';
        $order->save();

        return redirect()->action([MyTransactionsController::class, 'index'], ['status' => $status]);
    }

    public function confirmationreturned(Request $request, $status, $orderId)
    {
        $data = $request->validate([
            'receipt_number' => 'required|string|max:255',
        ]);

        // dd($data);

        $refund = Refund::where('order_id', $orderId)->first();
        // dd($refund);
        if (!$refund) {
            return redirect()->back()->withErrors(['order' => 'Order ID not found in Refund table']);
        }

        $refund->receipt_number = $data['receipt_number'];
        $refund->status = 'FINISHED';
        $refund->save();

        return redirect()->action([MyTransactionsController::class, 'index'], ['status' => $status]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
