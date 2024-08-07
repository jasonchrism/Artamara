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

                                    <p>{{ 'Rp' . number_format($product->orderDetail[0]->order->where('order_id', $orderId)->first()->total_price, 0, ',', '.') }}</p>


                                </div>



                            </div>
                        @endforeach
                    </div>
                @endforeach

                <hr style="color: var(--bg-overlay-2); border-width:3px;">
                <div class="price-total">

                    <p>Total:
                        <strong>{{ 'Rp' . number_format($orderData['grand_total'], 0, ',', '.') }}</strong>

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
                            <a href="{{$orderData['orderDetails']->payment->url}}" class="btn btn-primary">Pay Now</a>
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
                                <button class="btn-report" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{'reportordermodal-' . $orderId }}">Report</button>
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
                @elseif($status == 'RETURNED')
                    <div class="order-footer">
                        @if ($orderData['refund_status'] == 'ADMIN REVIEW' || $orderData['refund_status'] == 'ARTIST REVIEW' || $orderData['refund_status'] == 'ADMIN CONFIRMATION')
                            <div class="order-footer-kiri">
                                <p style="color: var(--primary)">On Review</p>
                                <p>Returned will be completed: <strong>{{ Carbon::parse($orderData['estimated_arrival'])->format('d F Y') }}</strong></p>
                            </div>
                        @elseif ($orderData['refund_status'] == 'ACCEPTED')
                            <div class="order-footer-kiri">
                                <p style="color: var(--primary)">Returned Approved</p>
                                <p>Please send back the item to get refund</p>
                            </div>
                        @elseif ($orderData['refund_status'] == 'FINISHED')
                            <div class="order-footer-kiri">
                                <p style="color: var(--primary)">Refund Successful</p>
                                <p>The money should be in your account at: <strong>{{ Carbon::parse($orderData['estimated_arrival'])->format('d F Y') }}</strong></p>
                            </div>
                        @elseif ($orderData['refund_status'] == 'REJECTED')
                            <div class="order-footer-kiri">
                                <p style="color: var(--primary)">Refund Rejected</p>
                                <p>The refund has been rejected</p>
                            </div>
                        @endif
                        <div class="order-footer-btn">
                            <button class="btn-bordered" data-bs-toggle="modal"
                                data-bs-target="#{{ 'orderDetailsModal-' . $orderId }}" data-bs-dismiss="modal">Order Details</button>

                            @if ($orderData['refund_status'] == 'FINISHED' || $orderData['refund_status'] == 'ADMIN REVIEW' || $orderData['refund_status'] == 'ARTIST REVIEW' || $orderData['refund_status'] == 'ADMIN CONFIRMATION')
                                <button href="" class="btn btn-primary" disabled>Confirm Return</button>
                            @else
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#{{ 'confirmationReturnedModal-' . $orderId }}" data-bs-dismiss="modal" class="btn btn-primary">Confirm Return</button>

                            @endif
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
                            @elseif ($status == "RETURNED")
                                @if ($orderData['refund_status'] == 'ADMIN REVIEW' || $orderData['refund_status'] == 'ARTIST REVIEW' || $orderData['refund_status'] == 'ADMIN CONFIRMATION')
                                    <p id="status_blue">On Review</p>
                                @endif
                                @if ($orderData['refund_status'] == 'REJECTED')
                                    <p id="status_red">Rejected</p>
                                @elseif ($orderData['refund_status'] == 'ACCEPTED')
                                    <p id="status_blue">Approved</p>
                                @elseif ($orderData['refund_status'] == 'FINISHED')
                                    <p id="status_yellow">Refund</p>
                                @endif

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
                                                <p>{{ 'Rp' . number_format($product->orderDetail[0]->order->where('order_id', $orderId)->first()->total_price, 0, ',', '.') }}</p>


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
                    @if ($status == 'RETURNED')
                        <div id="space-detail" class="returned-details">
                            <p id="variant-1">Report Details</p>
                            <div class="orderline-right">
                                <p id=left-orderline-2>Photo</p>
                                {{-- {{dd($orderData['refund'])}} --}}
                                <img src="{{$orderData['refund_photo']}}" alt="">
                            </div>
                            <div class="orderline-right">
                                <p id="left-orderline-2">Video</p>
                                <video width="320" height="240" controls>
                                    <source src="{{ $orderData['refund_video'] }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="orderline-right">
                                <p id=left-orderline-2-desc>Description</p>
                                {{-- {{dd($orderData['refund'])}} --}}
                                <p>{{$orderData['refund']->description}}</p>
                            </div>
                        </div>


                    @endif
                </div>
                @if ($status == "UNPAID")

                    <div class="order-detail-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <a href="{{$orderData['orderDetails']->payment->url}}" class="btn btn-primary">Pay Now</a>
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

    {{-- modal confirmation returned accepted --}}
    <div class="modal fade" id="{{ 'confirmationReturnedModal-' . $orderId }}" tabindex="-1" aria-labelledby="confirmationReturnedModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="confirmationReturned-content">
            <div class="confirmationReturned-header">
                <p class="confirmationReturned-title" id="exampleModalLabel">Confirm Return</p>
            </div>
            <div class="confirmationReturned-body">
              <p>Submit Your Tracking Number to Get Refund</p>
              <form class="form-confirmation-returned-order" action="/mytransactions/confirmationreturned/{{$status}}/{{$orderId}}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="receipt_number">Receipt Number</label>
                <input value="{{ old('receipt_number') }}" type="text" name="receipt_number" id="receipt_number"
                    class="form-control @error('receipt_number') is-invalid @enderror" placeholder="Receipt Number" required>
                @error('receipt_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <div class="confirmationReturned-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Confirm</button>
                </div>

              </form>
            </div>
          </div>
        </div>
  </div>

    {{-- modal report --}}
    <div class="modal fade" id="{{'reportordermodal-' . $orderId}}" tabindex="-1" aria-labelledby="reportordermodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="report-content">
                <div class="report-header">
                    <h1 class="report-title fs-5" id="exampleModalLabel">Report Order</h1>
                    <p>Submit a Return Get back your money</p>
                </div>
                <div class="report-body">
                    <form class="form-report-order" action="/mytransactions/report/{{$status}}/{{$orderId}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">

                            <label for="photo"><strong>Photo</strong></label>
                            <input name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror"
                                   placeholder="Select an image" required accept="image/png,image/jpg,image/jpeg" type="file">
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="video"><strong>Video</strong></label>
                            <input name="video" id="video" class="form-control @error('video') is-invalid @enderror"
                                   placeholder="Select a video" required accept="video/mp4" type="file">
                            @error('video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="description"><strong>Description</strong></label>
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') }}" autocomplete="off" placeholder="Describe your report" required
                                    style="height: 50%"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="report-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endforeach

@endsection
