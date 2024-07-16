<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.transaction');
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

    public function detail() {
        $order_id = '9c86777e-158d-4e78-8ca1-db7602ab5aa9';
        $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod'])
            ->where('order_id', $order_id)
            ->get();

        $items = Order::with(['orderDetail.product.user'])
            ->where('order_id', $order_id)
            ->get();

        return view('admin.transactionsDetail', [
            'orders' => $orders,
            'items' => $items
        ]);
    }
}
