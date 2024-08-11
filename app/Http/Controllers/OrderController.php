<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
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

use function PHPUnit\Framework\isEmpty;

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
                'quantity' => $order['quantity'],
                'isAuction' => false
            ];
            $total += $order['quantity'] * $product->price;
        }

        $order = collect($tempOrders);
        $groupedOrder = $order->groupBy('product.user.name');
        // dd($order);
        return view('buyer.order.orderDetails', compact('addressDefault', 'userAddress', 'isAddressNull', 'order', 'total', 'shipment', 'groupedOrder'));
    }
    public function createAuction(Request $request)
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
                'quantity' => $order['quantity'],
                'price' => $order['price'],
                'isAuction' => true
            ];
            $total += $order['quantity'] * $order['price'];
        }

        $order = collect($tempOrders);
        // dd($order);
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
            $data = Product::find($product);
            $tempStock = $data->stock - $quantity;
            if ($tempStock < 0) {
                return redirect()->route('front.productDetails', $product)->with([
                    'status' => 'error',
                    'address_title' => 'Cannot purchase more than ' . $data->stock . ' items'
                ]);
            }
            session([
                'order' =>
                [
                    [
                        'product' => $product,
                        'quantity' => $quantity,
                        'isAuction' => false
                    ]
                ],
                'state' => 'buy'
            ]);
            // dd(session('order'));
        } else if ($state == "cart") {
            $orders = $request->input('selected_products');
            $orders = json_decode($orders);
            $tempOrder = [];

            if (empty($orders)) {
                return redirect()->route('front.cart')->with([
                    'address_title' => 'You must select minimum 1 item',
                    'status' => 'error'
                ]);
            }
            foreach ($orders as $order) {
                // dd($order);
                $data = Product::find($order->product_id);
                // dd($order->quantity);
                $tempStock = $data->stock - $order->quantity;
                // dd($tempStock);
                if ($tempStock < 0) {
                    return redirect()->route('front.cart')->with([
                        'address_title' => 'Some items in your cart exceed the available stock. Please adjust the quantities',
                        'status' => 'error'
                    ]);
                }
                $tempOrder[] = [
                    'product' => $order->product_id,
                    'quantity' => $order->quantity
                ];
            };
            session([
                'order' => $tempOrder,
                'state' => 'cart'
            ]);
            // dd(session('order'));
        }else if ($state == "auction") {
            $lastBid = $request->input('last_bid');
            $product = $request->input('product');
            $product = json_decode($product)[0];
            $quantity = $request->input('quantity');
            $data = Product::find($product);
            // dd($lastBid);
            $tempStock = $data->stock - $quantity;
            if ($tempStock < 0) {
                return redirect()->route('front.productDetails', $product)->with([
                    'status' => 'error',
                    'address_title' => 'Cannot purchase more than ' . $data->stock . ' items'
                ]);
            }
            session([
                'order' =>
                [
                    [
                        'product' => $product,
                        'quantity' => $quantity,
                        'price' => $lastBid,
                        'isAuction' => true
                    ]
                ],
                'state' => 'auction'
            ]);
            // dd(session('order'));
            return redirect()->action([OrderController::class, 'createAuction']);
        }
        return redirect()->action([OrderController::class, 'create']);
    }

    public function store(Request $request)
    {
        $data = json_decode($request->input('order'));
        // dd($data[0]->product->product_id);
        $product_id = $data[0]->product->product_id;
        $productExistsInAuction = DB::table('product_auctions')->where('product_id', $product_id)->exists();
        // dd($productExistsInAuction);


        $orders = $request->get('order');
        $orders = json_decode($orders);
        $totalPrice = $request->input('totalPrice');
        $shipmentCost = $request->input('shipmentCost');
        $addressId = $request->input('addressId');
        $isAuction = session('order')[0]['isAuction'];
        // dd($isAuction);
        if (!isset($addressId) && $isAuction == false) {
            return redirect()->action([OrderController::class, 'create'])->with([
                'address_title' => 'Please select an address to proceed with your order.',
                'status' => 'error'
            ]);
        }else if (!isset($addressId) && $isAuction == true) {
            return redirect()->action([OrderController::class, 'createAuction'])->with([
                'address_title' => 'Please select an address to proceed with your order.',
                'status' => 'error'
            ]);
        }
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
            // Set sanitization on (default)z
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

            $state = session('state');
            $userId = Auth::user()->user_id;


            foreach ($orders as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->order_id;
                $orderDetail->product_id = $item->product->product_id;
                $orderDetail->quantity = $item->quantity;
                $orderDetail->save();

                $product = Product::find($orderDetail->product_id);

                $product->stock -= $orderDetail->quantity;
                $product->save();

                if ($state == "cart") {
                    $cart = Cart::where([['user_id', '=', $userId], ['product_id', '=', $orderDetail->product_id]])->first();
                    $cart->delete();
                }
            }

            // If the product is from an auction, update its status to "paid"
            if ($productExistsInAuction) {
                $productAuction = \App\Models\ProductAuction::where('product_id', $product_id)->first();
                $productAuction->status = 'PAID';
                $productAuction->end_date = Carbon::now('Asia/Jakarta');
                $productAuction->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect($paymentUrl);
    }

    public function payment(Request $request)
    {
        $orderId = $request->get('order_id');
        $status = $request->get('transaction_status');

        $order = Order::find($orderId);
        $payment = Payment::find($order->payment_id);
        if ($status == "settlement") {
            $payment->status = 'PAID';
        } else if ($status == "pending") {
            $payment->status = "UNPAID";
        } else if ($status == "failure") {
            $payment->status = 'CANCELLED';
        }
        $payment->save();
        return view('buyer.order.afterPayment', [
            'status' => $status
        ]);
    }
}
