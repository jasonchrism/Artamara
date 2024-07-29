<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            Log::info("hello");
            $data = Order::with(['orderDetail.product', 'payment.paymentMethod', 'user'])
                ->where('status', 'CONFIRMED')
                ->get();
            Log::info($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $detailsUrl = route('transactions.detail', $row->order_id);
                    // intinya ini untuk balikin dropdown ke tables
                    $modalId = 'modal-' . $row->order_id;
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
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item" href="' . $detailsUrl . '">Details</a></li>

                    </ul>
                </div>

                <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                                <h5 class="modal-title" id="' . $modalId . 'Label">Delete Product</h5>

                            <div class="content-body-delete">
                                <p style="color: var(--bs-secondary-txt);">Are you sure to delete this product?</p>
                            </div>
                            <div class="footer-modal-delete">

                            </div>
                        </div>
                    </div>
                </div>
                ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // dd('hello');
        // Ini untuk kasih nama page
        return view('admin.transaction');
    }

    public function tabs(Request $request, $status)
    {
        if ($request->ajax()) {
            $data = Order::where('status', $status)
                ->with(['orderDetail.product', 'payment.paymentMethod', 'user', 'refund'])
                ->get();
            $datatable = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('total_price', function($row){
                    return 'Rp' . number_format($row->total_price, 0, ',', '.');
                })
                ->addColumn('action', function ($row) use($status){
                    if($status == "CONFIRMED"){
                        $detailsUrl = route('transactions.detail', $row->order_id);
                    }else{
                        $detailsUrl = route('return.review', $row->order_id);
                    }
                    
                    $modalId = 'modal-' . $row->order_id;
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
                        <ul class="dropdown-menu custom-dropdown-menu">
                            <li><a class="dropdown-item" href="' . $detailsUrl . '">Details</a></li>
                        </ul>
                    </div>

                    <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
                    </div>
                ';
                    return $actionBtn;
                });

            // Conditionally add the 'status' column if the status is 'returned'
            if ($status == 'RETURNED') {
                $datatable->addColumn('status', function ($row) {
                    $status = ucfirst(strtolower($row->refund->status ?? 'Unknown'));

                    // Define the background color and text color based on status
                    switch ($status) {
                        case 'Admin review':
                            $backgroundColor = '#001F6E';
                            $textColor = '#95D3FF';
                            break;
                        case 'Artist review':
                            $backgroundColor = '#001F6E';
                            $textColor = '#95D3FF';
                            break;
                        case 'Admin confirmation':
                            $backgroundColor = '#401111';
                            $textColor = '#FC2D2D';
                            break;
                        case 'Rejected':
                            $backgroundColor = '#401111';
                            $textColor = '#FC2D2D';
                            break;
                        case 'Accepted':
                            $backgroundColor = '#4B5D02';
                            $textColor = '#CEFE06';
                            break;
                        case 'Finished':
                            $backgroundColor = '#4B5D02';
                            $textColor = '#CEFE06';
                            break;
                        default:
                            $backgroundColor = 'gray'; // Fallback color
                            $textColor = 'white';
                    }

                    // Return the styled status
                    return '
                    <div class="status-label" style="background-color: ' . $backgroundColor . '; color: ' . $textColor . '; padding: 5px 10px; display: inline-block;">
                        ' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '
                    </div>
                ';
                });
            }

            // Render raw columns that contain raw HTML
            return $datatable->rawColumns(['status', 'action'])->make(true);
        }

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

    public function detail($id)
    {

        $orders = Order::with(['userAddress.user', 'userAddress.address', 'payment.paymentMethod'])
            ->where('order_id', $id)
            ->get();

        $refund = Refund::where('order_id', $id)->get();

            // ini akan selalu redirect ke return detail selama dia masih status returned.
        // dd($refund);
        if($orders[0]->status == "RETURNED" && $refund[0]->status != "FINISHED")
        {
            return redirect()->route('return.review',['orderId' => $id]);
        }

        $items = Order::with(['orderDetail.product.user'])
            ->where('order_id', $id)
            ->get();

        return view('admin.transactionsDetail', [
            'orders' => $orders,
            'items' => $items
        ]);
    }
}
