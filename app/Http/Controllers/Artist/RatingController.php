<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $artist_id = Auth::id();
        if ($request->ajax()) {
            $data = Order::with(['user', 'refund', 'orderDetail.product.user', 'review'])
                ->whereHas('orderDetail.product.user', function ($query) use ($artist_id) {
                    $query->where('user_id', $artist_id);
                })
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('order_id', function ($row) {
                    return ucfirst(strtolower($row->order_id));
                })
                ->addColumn('buyer', function ($row) {
                    return ucfirst(strtolower($row->user->username));
                })
                ->addColumn('rating', function ($row) {
                    return ucfirst(strtolower(isset($row->review->rating) ? $row->review->rating : 0));
                })
                ->addColumn('comment', function ($row) {
                    return ucfirst(strtolower(isset($row->review->rating) ? $row->review->comment : 'No Comment'));
                })
                // intinya ini untuk button per-row
                ->addColumn('action', function ($row) {
                    $detailsUrl = route('rating.show', $row->order_id);
                    $modalId = 'modal-' . $row->order_id;
                    $actionBtn = '
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_219_3359)">
                            <path
                                d="M5 10C5.53043 10 6.03914 10.2107 6.41421 10.5858C6.78929 10.9609 7 11.4696 7 12C7 12.5304 6.78929 13.0391 6.41421 13.4142C6.03914 13.7893 5.53043 14 5 14C4.46957 14 3.96086 13.7893 3.58579 13.4142C3.21071 13.0391 3 12.5304 3 12C3 11.4696 3.21071 10.9609 3.58579 10.5858C3.96086 10.2107 4.46957 10 5 10ZM12 10C12.5304 10 13.0391 10.2107 13.4142 10.5858C13.7893 10.9609 14 11.4696 14 12C14 12.5304 13.7893 13.0391 13.4142 13.4142C13.0391 13.7893 12.5304 14 12 14C11.4696 14 10.9609 13.7893 10.5858 13.4142C10.2107 13.0391 10 12.5304 10 12C10 11.4696 10.2107 10.9609 10.5858 10.5858C10.9609 10.2107 11.4696 10 12 10ZM19 10C19.5304 10 20.0391 10.2107 20.4142 10.5858C20.7893 10.9609 21 11.4696 21 12C21 12.5304 20.7893 13.0391 20.4142 13.4142C20.0391 13.7893 19.5304 14 19 14C18.4696 14 17.9609 13.7893 17.5858 13.4142C17.2107 13.0391 17 12.5304 17 12C17 11.4696 17.2107 10.9609 17.5858 10.5858C17.9609 10.2107 18.4696 10 19 10Z"
                                fill="#464646" />
                            </g>
                            <defs>
                                <clipPath id="clip0_219_3359">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                            </svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . $detailsUrl . '">Details</a></li>
                        </ul>
                    </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('artist.rating');
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
        $orders = Order::with(['review', 'user', 'orderDetail.product'])
            ->where('order_id', $id)
            ->get();

        return view('artist.ratingDetail', [
            'orders' => $orders,
        ]);
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
