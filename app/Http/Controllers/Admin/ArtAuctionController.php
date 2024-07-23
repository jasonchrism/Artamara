<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArtAuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Product::
            whereHas('productAuction')
            ->with(['productAuction' => function ($query) {
                // Eager load the productAuction relationship and calculate the current bid
                $query->withCount(['bid as current_bid' => function ($subquery) {
                    $subquery->select(DB::raw('MAX(bid_price)'));
                }]);
            }])
            ->get()
            ->map(function ($product) {
                // If there are no bids, set current_bid to the start_price
                if (isset($product->productAuction)) {
                    $product->productAuction->current_bid = $product->productAuction->current_bid ?? $product->productAuction->start_price;
                }
                return $product;
            });
        // dd($data);

        // dd($data);
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('start_date', function ($row) {
                    return Carbon::parse($row->productAuction->start_date)->format('M, d Y');
                })
                ->addColumn('end_date', function ($row) {
                    return Carbon::parse($row->productAuction->end_date)->format('M, d Y');
                })
                ->addColumn('start_price', function ($row) {
                    return 'Rp' . number_format($row->productAuction->start_price, 0, ',', '.');
                })
                ->addColumn('current_bid', function ($row) {
                    return 'Rp' . number_format($row->productAuction->current_bid, 0, ',', '.');
                })
                ->addColumn('status', function ($row) {
                    // return ucfirst(strtolower($row->productAuction->status));
                    $status = ucfirst(strtolower($row->productAuction->status));
                    $statusStyle = '';

                    if ($status == 'Starting soon') {
                        $statusStyle = '
                            <div class="inner-content-container bidstatus">
                                <div class="status-container" style="background-color: var(--bg-overlay-2);">
                                    <p style="color: var(--text-secondary);">' . $status . '</p>
                                </div>
                            </div>
                        ';
                    } elseif ($status == 'On going') {
                        $statusStyle = '
                            <div class="inner-content-container bidstatus">
                                <div class="status-container" style="background-color: var(--bg-label-blue);">
                                    <p style="color: #95D3FF;">' . $status . '</p>
                                </div>
                            </div>
                        ';
                    } elseif ($status == 'Closed') {
                        $statusStyle = '
                            <div class="inner-content-container bidstatus">
                                <div class="status-container" style="background-color: var(--bg-label-primary);">
                                    <p style="color: var(--primary);">' . $status . '</p>
                                </div>
                            </div>
                        ';
                    }
                    return $statusStyle;
                })
                ->addColumn('action', function ($row) {
                    $detailsUrl = route('artist-auction.show', $row->product_id);
                    // intinya ini untuk balikin dropdown ke tables
                    $modalId = 'modal-' . $row->product_id;
                    $csrfToken = csrf_token();
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
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        // Ini untuk kasih nama page
        $pageTitle = 'Products';
        return view('admin.auction', [
            'pageTitles' => $pageTitle,
        ], compact('data'));
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
