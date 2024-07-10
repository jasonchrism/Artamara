<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6)->startOfMonth();

        $order = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total_orders, SUM(total_price) as total_price')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $totalPrice = array_fill(0, 5, 0); 

        for ($i = 0; $i < 6; $i++) {
            $month = Carbon::now()->subMonths($i)->format('n');
            $totalPrice[$i] = isset($order[$i]['total_price']) ? $order[$i]['total_price'] : 0;
        }

        return view('admin.home', compact('totalPrice'));
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
