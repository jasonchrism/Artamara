<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\UserAddress;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $userId = Auth::user()->user_id;
        $addressDefault = UserAddress::where('user_id', '=', $userId)->where('is_default', 1)->first();

        $userAddress = UserAddress::where('user_id', '=', $userId)->get();

        $isAddressNull = $userAddress->first();
        $orders = session('order');
        $tempOrders = [];
        $total = 0;
        $shipment = [
            'cost' => 0,
            'region' => 'Unknown'
        ];

        if ($addressDefault) {
            if ($addressDefault->address->country == "Indonesia") {
                $shipment = [
                    'cost' => 40000,
                    'region' => 'Domestic'
                ];
            } else {
                $shipment = [
                    'cost' => 80000,
                    'region' => 'International'
                ];
            }
        }

        foreach ($orders as $order) {
            $product = Product::find($order['product']);
            $tempOrders[] = [
                'product' => $product,
                'quantity' => $order['quantity']
            ];
            $total += $order['quantity'] * $product->price;
        }

        $order = collect($tempOrders);
        $groupedOrder = $order->groupBy('product.user.name');
        // dd($order);
        return view('buyer.order.orderDetails', compact('addressDefault', 'userAddress', 'isAddressNull', 'order', 'total', 'shipment', 'groupedOrder'));
    }

    public function addSession(Request $request, $state)
    {
        if ($state == "buy") {
            $product = $request->input('product');
            $product = json_decode($product)[0];
            $quantity = $request->input('quantity');
            session([
                'order' =>
                [
                    [
                        'product' => $product,
                        'quantity' => $quantity
                    ]
                ]
            ]);
            // dd(session('order'));
        } else if ($state == "cart") {
            $orders = $request->input('selected_products');
            $orders = json_decode($orders);
            $tempOrder = [];
            foreach ($orders as $order) {
                $tempOrder[] = [
                    'product' => $order->product_id,
                    'quantity' => $order->quantity
                ];
            };
            session([
                'order' => $tempOrder
            ]);
            // dd(session('order'));
        }
        return redirect()->action([OrderController::class, 'create']);
    }

    public function store(Request $request)
    {
        $orders = $request->get('order');
        $orders = json_decode($orders);
        $totalPrice = $request->input('totalPrice');
        $shipmentCost = $request->input('shipmentCost');
        $addressId = $request->input('addressId');

        try {

            $now = Carbon::now('Asia/Jakarta');

            // Add 24 hours to the current time
            $timePlus24Hours = $now->addHours(24);

            // Format the time as needed
            $formattedTime = $timePlus24Hours->toDateTimeString();

            DB::beginTransaction();

            $order = new Order();
            $order->total_price = $totalPrice;
            $order->user_id = Auth::user()->user_id;
            $order->status = 'PACKING';
            $order->shipment_fee = $shipmentCost;
            $order->address_id = $addressId;
            $order->is_auction = 0;
            $order->end_date = $formattedTime;
            $order->save();
            
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.isProduction');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('midtrans.is3ds');


            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->order_id,
                    'gross_amount' => $shipmentCost + $totalPrice,
                )
            );

            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            $payment = new Payment();
            $payment->url = $paymentUrl;
            $payment->payment_method_id = '1';
            $payment->save();

            $order->payment_id = $payment->payment_id;
            $order->save();

            foreach ($orders as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->order_id;
                $orderDetail->product_id = $item->product->product_id;
                $orderDetail->quantity = $item->quantity;
                $orderDetail->save();

                $product = Product::find($orderDetail->product_id);
                $product->stock -= $orderDetail->quantity;
                $product->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect($paymentUrl);
    }

    public function success(Request $request)
    {
        $orderId = $request->get('order_id');
        $status = $request->get('transaction_status');

        $order = Order::find($orderId);
        $payment = Payment::find($order->payment_id);
        if($status == "settlement"){
            $payment->status = 'PAID';
        }
        $payment->save();
    }
}
