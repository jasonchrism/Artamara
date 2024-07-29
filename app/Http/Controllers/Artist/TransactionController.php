<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Address;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  asumsikan untuk saat ini hanya untuk menampilkan packing
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $authUserId = Auth::user()->user_id;
            $data = Order::with(['orderDetail.product', 'payment.paymentMethod', 'user'])
                ->where('status', 'PACKING')
                ->whereHas('orderDetail.product', function ($query) use ($authUserId) {
                    $query->where('user_id', $authUserId);
                })
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $detailsUrl = route('artist-transactions.show', $row->order_id);
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
        return view('artist.transaction');
    }
    public function tabs(Request $request, $status)
    {
        if ($request->ajax()) {
            $authUserId = Auth::user()->user_id;
            $data = Order::where('status', $status)
                ->with(['orderDetail.product', 'payment.paymentMethod', 'user' , 'refund'])
                ->whereHas('orderDetail.product', function ($query) use ($authUserId) {
                    $query->where('user_id', $authUserId);
                })
                ->get();
            
            $datatable = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('total_price', function($row){
                    return 'Rp' . number_format($row->total_price, 0, ',', '.');
                })
                ->addColumn('action', function ($row) use($status) {
                    if($status == "RETURNED"){
                        $detailsUrl = route('return.index', [$row->order_id, $row->refund->status]);
                    }else{
                        $detailsUrl = route('artist-transactions.show', $row->order_id);
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
                            $backgroundColor = 'var(--bg-overlay-2)';
                            $textColor = 'var(--text-secondary)';
                            break;
                        case 'Artist review':
                            $backgroundColor = 'var(--bg-label-blue)';
                            $textColor = '#95D3FF';
                            break;
                        case 'Admin confirmation':
                            $backgroundColor = 'var(--bg-label-primary)';
                            $textColor = 'green';
                            break;
                        case 'Rejected':
                            $backgroundColor = 'var(--bg-label-primary)';
                            $textColor = 'var(--primary)';
                            break;
                        case 'Accepted':
                            $backgroundColor = 'var(--bg-label-primary)';
                            $textColor = 'red';
                            break;
                        case 'Finished':
                            $backgroundColor = 'var(--bg-label-primary)';
                            $textColor = 'white';
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

        return view('artist.transaction');
    }


    /**
     * Show the form for creating a new resou   rce.
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
    public function show(string $artist_transaction)
    {
        $authUserId = Auth::user()->user_id;
        $data = Product::whereHas('orderDetail', function ($query) use ($artist_transaction) {
            $query->where('order_id', $artist_transaction);
        })
            ->with(['orderDetail.order', 'user'])
            ->orderBy('user_id') // Assuming user_id is the artist's id
            ->get();

        $groupedProducts = [];
        foreach ($data as $product) {

            // ini nambahin table order detail ke product

            foreach ($product->orderDetail as $orderDetail) {
                if ($orderDetail->order_id != $artist_transaction) {
                    continue; // Skip if order_id does not match the specific order_id
                }

                $address_ID = Order::with('userAddress')
                    ->where('order_id', $orderDetail->order_id)
                    ->pluck('address_id')
                    ->first();

                // dd($address_ID);
                $address = Address::where('address_id', $address_ID)
                    ->first();

                $payment_id = Order::where('order_id', $orderDetail->order_id)->pluck('payment_id')->first();
                // dd($payment_id);

                $paymentmethod_id = Payment::with('PaymentMethod')
                    ->where('payment_id', $payment_id)
                    ->pluck('payment_method_id')
                    ->first();
                // dd($address);

                $payment_method = PaymentMethod::where('payment_method_id', $paymentmethod_id)->pluck('name')->first();
                // dd($payment_method);

                // ini orderID yang diambil dari orderDetail di table order
                $orderId = $orderDetail->order->order_id;

                $total = $orderDetail->order->total_price;
                $shipment = $orderDetail->order->shipment_fee;
                $grand_total = $total + $shipment;
                // dd($grand_total);
                // ini ambil user id sesuai dari product yang dicek
                $artistId = $product->user_id; // Assuming user_id is the artist's ID
                $artistName = $product->user->name; // Assuming 'name' is the field for artist's name

                // ini ambil tanggalnya
                $createdAt = $orderDetail->order->created_at;
                $orderstatus = $orderDetail->order->status;
                // $buyer = $orderDetail->user->name;
                $buyer = $orderDetail->order->user->name;

                $paymentMax = Carbon::parse($createdAt)->addHours(24);

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
                        'buyer' => $buyer,
                        'shipment_number' => $orderDetail->order->receipt_number,
                        'artists' => []
                    ];
                }

                // di sini tuh cek orderid sekian dari dari array groupedproducts
                // nah, cek apakah di array artists, cek apakah ada index dari artistID
                // kalau belum, bikin array lagi di dalam artist untuk index itu
                if (!isset($groupedProducts[$orderId]['artists'][$artistId])) {
                    $groupedProducts[$orderId]['artists'][$artistId] = [
                        'name' => $artistName,
                        'products' => []
                    ];
                }

                // nah, ini product-nya, isi dari tralala itu
                $groupedProducts[$orderId]['artists'][$artistId]['products'][] = [
                    'product' => $product,
                    'quantity' => $orderDetail->quantity
                ];
            }
        }
        // dd($groupedProducts, $artist_transaction);
        return view('artist.transactionDetail', compact('groupedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // dd($id, $request->all());
        $order = Order::findOrFail($id);

        $order->receipt_number = $request->input('receipt_number');

        if ($order->status === 'PACKING') {
            $order->status = 'SHIPPING';
        }

        $order->save();
        // Redirect back with a success message
        return redirect()->route('artist-transactions.index')->with('success', 'Receipt number updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
