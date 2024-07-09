<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Product;
use App\Models\UserAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'cost' => 80000,
            'region' => 'International'
        ];

        if($addressDefault->userAddress->country == "Indonesia"){
            $shipment = [
                'cost' => 40000,
                'region' => 'Domestic'
            ];
        }

        foreach($orders as $order){
            $product = Product::find($order['product']);
            $tempOrders[] = [
                'product' => $product,
                'quantity' => $order['quantity']
            ];
            $total += $order['quantity'] * $product->price; 
        }

        $order = collect($tempOrders);
        $grandTotal = $total + $shipment['cost'];

        return view('buyer.order.orderDetails', compact('addressDefault', 'userAddress', 'isAddressNull', 'order', 'total', 'shipment', 'grandTotal'));
    }

    public function addSession(Request $request)
    {
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
        return redirect()->action([OrderController::class, 'create']);
    }

    public function store(){
        
    }
}
