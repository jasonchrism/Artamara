<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductAuction;
use App\Models\Refund;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artist_id = Auth::id();

        // Monthly Earnings
        $sixMonthsAgo = Carbon::now()->subMonths(6)->startOfMonth();

        $orders = Order::with(['orderDetail.product'])
            ->whereHas('orderDetail.product', function ($query) use ($artist_id) {
            $query->where('user_id', $artist_id);
        })
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total_orders, SUM(total_price) as total_price')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->limit(6)
            ->get();
        
        $totalPrice = array_fill(0, 5, 0);
        for ($i = 0; $i < 6; $i++) {
            $month = Carbon::now()->subMonths($i)->format('n');
            $totalPrice[$i] = isset($orders[$i]['total_price']) ? $orders[$i]['total_price'] : 0;
        }

        $totalPrice = array_reverse($totalPrice);

        // Return Requests
        $returnRequests = Refund::whereHas('order.orderDetail.product', function ($query) use ($artist_id) {
            $query->where('user_id', $artist_id);
        })->with(['order.orderDetail.product' => function ($query) use ($artist_id) {
            $query->where('user_id', $artist_id);
        }])
            ->where('status', 'ARTIST REVIEW')
            ->orderBy('created_at', 'asc')
            ->get();

        // Recent Transactions
        $recentTransactions = Order::whereHas('orderDetail.product', function ($query) use ($artist_id) {
            $query->where('user_id', $artist_id);
        })->with(['orderDetail' => function ($query) use ($artist_id) {
            $query->whereHas('product', function ($query) use ($artist_id) {
                $query->where('user_id', $artist_id);
            });
        }])
            ->orderBy('created_at', 'asc')
            ->take(10)
            ->get();

        foreach ($recentTransactions as $recent) {
            $recent->formatted_date = $recent->created_at->format('F d, Y');
        }

        // On Going Auctions
        $onGoingAuctions = ProductAuction::whereHas('product', function ($query) use ($artist_id) {
            $query->where('user_id', $artist_id);
        })->get();

        foreach ($onGoingAuctions as $auction) {
            $createdAt = Carbon::parse($auction->created_at);
            $now = Carbon::now();
            $diff = $now->diff($createdAt);

            $remainingTime = '';
            if ($diff->d > 0) {
                $remainingTime .= $diff->d . 'd : ';
            }
            if ($diff->h > 0) {
                $remainingTime .= $diff->h . 'h : ';
            }
            if ($diff->i > 0) {
                $remainingTime .= $diff->i . 'm : ';
            }
            if ($diff->s > 0) {
                $remainingTime .= $diff->s . 's';
            }

            $auction->remaining_time = $remainingTime;
        }

        // Total Earnings
        $total = [
            'product_count' => Product::where('user_id', $artist_id)->count(),
            'auction_count' => ProductAuction::whereHas('product', function ($query) use ($artist_id) {
                $query->where('user_id', $artist_id);
            })->count(),
            'order_count' => Order::whereHas('orderDetail.product', function ($query) use ($artist_id) {
                $query->where('user_id', $artist_id);
            })->count(),
            'total_earnings' => 'Rp' . number_format(Order::whereHas('orderDetail.product', function ($query) use ($artist_id) {
                $query->where('user_id', $artist_id);
            })->sum('total_price'), 0, ',', '.')
        ];

        return view('artist.home', [
            'recentTransactions' => $recentTransactions,
            'totalPrice' => $totalPrice,
            'onGoingAuctions' => $onGoingAuctions,
            'returnRequests' => $returnRequests,
            'total' => $total
        ]);
    }

    public function showProfile()
    {
        $artist_id = Auth::user()->user_id;
        $user = User::query()->where('user_id', $artist_id)->get();
        $address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
            ->where('user_addresses.user_id', '=', $artist_id)
            ->orderBy('user_addresses.is_default', 'desc')
            ->get();

        return view('artist.myprofile', [
            'artist' => $user[0],
            'address' => $address[0],
        ]);
    }

    public function editProfile(Request $request)
    {
        $artist_id = Auth::user()->user_id;
        $user = User::query()->where('user_id', $artist_id)->get();
        $address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
            ->where('user_addresses.user_id', '=', $artist_id)
            ->orderBy('user_addresses.is_default', 'desc')
            ->get();

        $address = Address::find($address[0]['address_id']);

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:1'],
            'username' => ['required', 'string', 'max:255', 'min:1'],
            'phone_number' => 'required|min:10|max:15',
            'profile_picture' => 'image|mimes:png,jpg,jpeg|max:2048',
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => 'required|min:3|max:5|regex:/^[0-9]+$/',
            'description' => ['required', 'string', 'max:255'],
        ]);

        try {
            $photoPath = $user[0]['profile_picture'];
            if (request()->hasFile('profile_picture')) {
                $photoPath = request()->file('profile_picture')->store('photos', 'public');
            }

            DB::beginTransaction();
            $address->update([
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'district' => $request->input('district'),
                'postal_code' => $request->input('postal_code'),
                'province' => $request->input('province'),
            ]);
            $user[0]->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'about' => $request->input('description'),
                'phone_number' => $request->input('phone_number'),
                'profile_picture' => $photoPath,
            ]);

            DB::commit();
        } catch (Exception $e) {
            dd(3);
            DB::rollBack();
            return redirect('/dashboard/artist/myprofile')->with([
                'address_title' => 'Profile not updated!',
                'status' => 'error'
            ]);
        }

        return redirect('/dashboard/artist/myprofile');
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
