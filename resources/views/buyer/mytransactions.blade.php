@vite('resources/css/buyer/mytransactions.css')
@extends('layouts.app')

@section('content')
@include('includes.addressNotification')
    @php
        use Carbon\Carbon;
    @endphp

    <div style="margin-top: 62px;">
        <ul class="nav nav-pills" id="myTab">
            <li class="nav-item tab-link {{ $status == 'UNPAID' ? 'tab-active' : '' }}">
                <a class="" href="{{ route('front.mytransactions', ['status' => 'UNPAID']) }}">Payment</a>
            </li>
            <li class="nav-item tab-link {{ $status == 'PACKING' ? 'tab-active' : '' }}">
                <a class="" href="{{ route('front.mytransactions', ['status' => 'PACKING']) }}">Packing</a>
            </li>
            <li class="nav-item tab-link {{ $status == 'SHIPPING' ? 'tab-active' : '' }}">
                <a class="" href="{{ route('front.mytransactions', ['status' => 'SHIPPING']) }}">Shipping</a>
            </li>
            <li class="nav-item tab-link {{ $status == 'CONFIRMED' ? 'tab-active' : '' }}">
                <a class="" href="{{ route('front.mytransactions', ['status' => 'CONFIRMED']) }}">Finished</a>
            </li>
            <li class="nav-item tab-link {{ $status == 'RETURNED' ? 'tab-active' : '' }}">
                <a class="" href="{{ route('front.mytransactions', ['status' => 'RETURNED']) }}">Returned</a>
            </li>
            <li class="nav-item tab-link {{ $status == 'CANCELLED' ? 'tab-active' : '' }}">
                <a class="" href="{{ route('front.mytransactions', ['status' => 'CANCELLED']) }}">Cancelled</a>
            </li>
        </ul>
    </div>

    <div class="transaction-container">

        {{-- {{dd($status)}} --}}
        @foreach ($groupedProducts as $orderId => $orderData)
            @php
                $dateDisplayed = false;
                // $modalId = 'orderDetailsModal-' . $orderId;
            @endphp
            <div class="order-container">
                {{-- ini udah di loop untuk masing-masing artist --}}
                {{-- dari artist, kita dapat si productsnya --}}
                @foreach ($orderData['artists'] as $artistId => $products)
                    @if (count($products) > 0)
                        <div class="artist-profile">

                            <div class="artist-profile-left">

                                <img src="{{ Storage::url($products[0]->user->profile_picture) }}" alt="artist-profile">
                                <p>{{ $products[0]->user->name }}</p>

                            </div>

                            <div class="artist-profile-right">
                                @if (!$dateDisplayed)
                                    <p>{{ Carbon::parse($orderData['created_at'])->format('d F Y') }}</p>
                                    @php
                                        $dateDisplayed = true;
                                    @endphp
                                @endif

                            </div>

                        </div>
                    @endif

                    <div>
                        @foreach ($products as $product)
                            <!-- Display product details here -->
                            <div class="products-list">

                                <div class="product-list-left">

                                    <div class="product-list-left-img">
                                        <img src="{{ $product->thumbnail }}" alt="" class="card-img-top">

                                    </div>
                                    <div class="product-list-left-desc">

                                        <p>{{ $product->title }}</p>
                                        <p>{{ $product->orderDetail->where('order_id', $orderId)->first()->quantity }}x</p>


                                    </div>

                                </div>

                                <div class="product-list-left">

                                    <p>{{ 'Rp' . number_format($product->price, 0, ',', '.') }}</p>


                                </div>



                            </div>
                        @endforeach
                    </div>
                @endforeach

                <hr style="color: var(--bg-overlay-2); border-width:3px;">
                <div class="price-total">

                    <p>Total:
                        <strong>{{ 'Rp' . number_format($product->orderDetail[0]->order->where('order_id', $orderId)->first()->total_price, 0, ',', '.') }}</strong>

                    </p>

                </div>

                {{-- if footer berdasarkan statusnya --}}
                @if ($status == 'UNPAID')

                    <div class="order-footer">
                        <div class="order-footer-kiri">
                            <p style="color: var(--primary)">Waiting for payment</p>
                            <p>Max payment:
                                <strong>{{ Carbon::parse($orderData['payment_max'])->format('d F Y H:i:s') }}</strong></p>
                        </div>
                        <div class="order-footer-btn">
                            <button class="btn-bordered" data-bs-toggle="modal"
                                data-bs-target="#{{ 'orderDetailsModal-' . $orderId }}" data-bs-dismiss="modal">Order Details</button>
                            <button class="btn btn-primary">Pay Now</button>
                        </div>
                    </div>

                @elseif ($status == 'PACKING')
                    <div id = "order-footer-packing"  class="order-footer">
                        <div class="order-footer-btn">
                            <button id="btn-bordered-packing" class="btn-bordered" data-bs-toggle="modal"
                                data-bs-target="#{{ 'orderDetailsModal-' . $orderId }}" data-bs-dismiss="modal">
                                Order Details
                            </button>

                        </div>
                    </div>

                @elseif ($status == 'SHIPPING')
                    @if ($orderData['orderstatus'] == 'SHIPPING')
                        <div class="order-footer">
                            <div class="order-footer-kiri">

                                <p style="color: var(--primary)">On Shipping</p>
                                <p>Estimated arrival: <strong>{{ Carbon::parse($orderData['estimated_arrival'])->format('d F Y') }}</strong></p>
                            </div>
                            <div class="order-footer-btn">
                                <button class="btn-bordered" data-bs-toggle="modal" data-bs-target="#{{ 'orderDetailsModal-' . $orderId }}" data-bs-dismiss="modal">Order Details</button>
                                <button class="btn-report" disabled>Report</button>
                                <button class="btn btn-primary" disabled>Confirmed Order</button>
                            </div>
                        </div>
                    @elseif ($orderData['orderstatus'] == 'DELIVERED')
                        <div class="order-footer">
                            <div class="order-footer-kiri">

                                <p style="color: var(--primary)">Received</p>
                                <p>Delivered at: <strong>{{ Carbon::parse($orderData['estimated_arrival'])->format('d F Y') }}</strong></p>
                            </div>
                            <div class="order-footer-btn">
                                <button class="btn-bordered" data-bs-toggle="modal" data-bs-target="#{{ 'orderDetailsModal-' . $orderId }}" data-bs-dismiss="modal">Order Details</button>
                                <button class="btn-report">Report</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ 'confirmationModal-' . $orderId }}" data-bs-dismiss="modal">Confirmed Order</button>
                            </div>
                        </div>
                    @endif
                @elseif ($status == 'CONFIRMED')
                    <div class="order-footer">
                        <div class="order-footer-kiri">
                            <p style="color: var(--primary)">Confirmed</p>
                            <p>Confirmed at: <strong>{{ Carbon::parse($orderData['estimated_arrival'])->format('d F Y') }}</strong></p>
                        </div>
                        <div class="order-footer-btn">
                            <button class="btn-bordered" data-bs-toggle="modal"
                                data-bs-target="#{{ 'orderDetailsModal-' . $orderId }}" data-bs-dismiss="modal">Order Details</button>
                            
                            <a href="/review/{{$orderId}}" class="btn btn-primary">Review</a>
                        </div>
                    </div>

                @elseif ($status == 'CANCELLED')
                    <div class="order-footer">
                        <div class="order-footer-kiri">
                            <p style="color: var(--primary)">Cancelled</p>
                            {{-- ini asal dulu cancelnya?? --}}
                            <p>Cancelled at: <strong>{{ Carbon::parse($orderData['estimated_arrival'])->format('d F Y') }}</strong></p>
                        </div>
                        <div class="order-footer-btn">
                            <button class="btn-bordered" data-bs-toggle="modal"
                                data-bs-target="#{{ 'orderDetailsModal-' . $orderId }}" data-bs-dismiss="modal">Order Details</button>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- ini untuk order details modal --}}
    @foreach ($groupedProducts as $orderId => $orderData)
    {{-- {{dd($orderData)}} --}}
    <div class="modal fade" id="{{ 'orderDetailsModal-' . $orderId }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="order-content">

                <div class="order-header">
                    <p class="order-title" id="exampleModalLabel">Order Details</p>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <svg width="25" height="25" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.53341 19.3327L0.666748 17.466L8.13341 9.99935L0.666748 2.53268L2.53341 0.666016L10.0001 8.13268L17.4667 0.666016L19.3334 2.53268L11.8667 9.99935L19.3334 17.466L17.4667 19.3327L10.0001 11.866L2.53341 19.3327Z" fill="#464646"/>
                        </svg>

                    </button>
                </div>

                <div class="order-body">
                    <div id="space-detail" class="order-detail">
                        <p id="variant-1">Order</p>
                        <div class="orderline">
                            <p id="left-orderline">Order Id</p>
                            <p>{{$orderId}}</p>
                        </div>
                        <div class="orderline">
                            <p id="left-orderline">Status</p>
                            @if ($status == 'UNPAID')
                                <p id="status_red">Waiting for payment</p>
                            @elseif ($status == "PACKING")
                                <p id="status_blue">On Packing</p>
                            @elseif ($status == "SHIPPING")
                                @if ($orderData['orderstatus'] == 'SHIPPING')
                                    <p id="status_blue">On Shipping</p>
                                @elseif ($orderData['orderstatus'] == 'DELIVERED')
                                    <p id="status_blue">Received</p>
                                @endif
                            @elseif ($status == "CONFIRMED")
                                <p id="status_yellow">Finished</p>
                            @elseif ($status == "CANCELLED")
                                <p id="status_red">Cancelled</p>
                            @endif

                        </div>
                        <div class="orderline">
                            <p id="left-orderline">Purchase date</p>
                            <p>{{ Carbon::parse($orderData['payment_max'])->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div id="space-detail" class="painting-list">
                        <p id="variant-1">Product Details</p>
                        <div id="order-container-modal" class="order-container">
                            {{-- ini udah di loop untuk masing-masing artist --}}
                            {{-- dari artist, kita dapat si productsnya --}}
                            @foreach ($orderData['artists'] as $artistId => $products)
                                @if (count($products) > 0)
                                    <div class="artist-profile">

                                        <div class="artist-profile-left">

                                            <img src="{{ Storage::url($products[0]->user->profile_picture) }}" alt="artist-profile">
                                            <p>{{ $products[0]->user->name }}</p>

                                        </div>

                                        <div class="artist-profile-right">
                                            @if (!$dateDisplayed)
                                                <p>{{ Carbon::parse($orderData['created_at'])->format('d F Y') }}</p>
                                                @php
                                                    $dateDisplayed = true;
                                                @endphp
                                            @endif

                                        </div>

                                    </div>
                                @endif

                                <div>
                                    @foreach ($products as $product)
                                        <!-- Display product details here -->
                                        <div class="products-list">

                                            <div class="product-list-left">

                                                <div class="product-list-left-img">
                                                    <img src="{{ $product->thumbnail }}" alt="" class="card-img-top">

                                                </div>
                                                <div class="product-list-left-desc">

                                                    <p>{{ $product->title }}</p>
                                                    <p>{{ $product->orderDetail->where('order_id', $orderId)->first()->quantity }}x</p>

                                                </div>

                                            </div>

                                            <div class="product-list-left">
                                                <p>{{ 'Rp' . number_format($product->price, 0, ',', '.') }}</p>


                                            </div>



                                        </div>
                                    @endforeach
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div id="space-detail" class="shipment-details">
                        <p id="variant-1">Shipment Details</p>
                        <div class="address">
                            <p id="left-orderline" style="padding-right: 54px;">Address</p>
                            <div class="address-row">
                                <p style="font-weight: 400px;"><strong>{{ $orderData['buyer_address']['receiver']}}</strong></p>
                                <p>{{ $orderData['buyer_address']['phone_number']}}</p>
                                <p>{{ $orderData['buyer_address']['street']}}, {{ $orderData['buyer_address']['district']}}</p>
                                <p>{{ $orderData['buyer_address']['city']}}</p>
                                <p>{{ $orderData['buyer_address']['district']}} {{ $orderData['buyer_address']['postal_code']}}</p>

                            </div>
                        </div>
                    </div>
                    <div id="space-detail" class="payment-details">
                        <p id="variant-1">Payment Details</p>
                        <div class="orderline">
                            <p id="left-orderline">Payment method</p>
                            <p>{{$orderData['payment_method']}}</p>

                        </div>
                        <div class="orderline">
                            <p id="left-orderline">Total price</p>
                            <p>{{ 'Rp' . number_format($product->orderDetail[0]->order->where('order_id', $orderId)->first()->total_price, 0, ',', '.') }}</p>

                        </div>

                        <div class="orderline">
                            <p id="left-orderline">Total shipment</p>
                            <p>{{ 'Rp' . number_format($product->orderDetail[0]->order->where('order_id', $orderId)->first()->shipment_fee, 0, ',', '.') }}</p>

                        </div>

                        <div class="orderline">
                            <p id="left-orderline">Grand total</p>

                            <p>{{ 'Rp' . number_format($orderData['grand_total'], 0, ',', '.') }}</p>

                        </div>

                    </div>
                </div>
                @if ($status == "UNPAID")

                    <div class="order-detail-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Paynow</button>
                    </div>
                @endif
          </div>
        </div>
    </div>
    {{-- modal confirmation order --}}
    <div class="modal fade" id="{{ 'confirmationModal-' . $orderId }}" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="confirmation-content">
              <div class="confirmation-header">
                  <p class="confirmation-title" id="exampleModalLabel">Confirm Order</p>
              </div>
              <div class="confirmation-body">
                <p>Confirming this order will finalize your purchase and initiate the payment process. Once confirmed, changes to the order will not be permitted.</p>
              </div>
              <div class="confirmation-footer">

                <form action="{{route('front.confirmTransactions', ['status' => $status, 'orderId' => $orderId])}}" method="post">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>

                </form>
              </div>
            </div>
          </div>
    </div>
    @endforeach

@endsection
