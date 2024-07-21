@vite('resources/css/buyer/myBids.css')
@vite('resources/css/buyer/productAuction.css')
@vite('resources/css/artist/transactions/transactionDetail.css')
@extends('layouts.app')

@section('content')
    @include('includes.addressNotification')
    @php
        use Carbon\Carbon;
    @endphp

    <div style="margin-top: 62px;">
        <ul class="nav nav-pills" id="myTab">
            <li class="nav-item tab-link {{ $status == 'ON GOING' ? 'tab-active' : '' }}">
                <a class="" href="{{ route('front.myBids', ['status' => 'ON GOING']) }}">On Going</a>
            </li>
            <li class="nav-item tab-link {{ $status == 'CLOSED' ? 'tab-active' : '' }}">
                <a class="" href="{{ route('front.myBids', ['status' => 'CLOSED']) }}">Closed</a>
            </li>
        </ul>
    </div>

    <div class="transaction-container">
        @foreach ($productsWithBids as $item)
            @php
                $dateDisplayed = false;
            @endphp
            <div class="order-container">
                <div class="artist-profile">
                    <div class="artist-profile-left">
                        <img src="{{ Storage::url($item['product']->user->profile_picture) }}" alt="artist-profile">
                        <p>{{ $item['product']->user->name }}</p>
                    </div>
                    <div class="artist-profile-right">
                        @if (!$dateDisplayed)
                            <p>{{ Carbon::parse($item['product']->productAuction->created_at)->format('d F Y') }}</p>
                            @php
                                $dateDisplayed = true;
                            @endphp
                        @endif
                    </div>
                </div>
                <div>
                    <!-- Display product details here -->
                    <div class="products-list">
                        <div class="product-list-left">
                            <div class="product-list-left-img">
                                <img src="{{ $item['product']->thumbnail }}" alt="" class="card-img-top">
                            </div>
                            <div class="product-list-left-desc">
                                <p>{{ $item['product']->title }}</p>
                                <p>{{ $item['product']->year }}</p>
                            </div>
                        </div>
                        <div class="lats-bid">
                            <p style="color: var(--text-secondary); font-size:14px ; font-weight:400">Your latest bid</p>
                            <div class="">
                                <p>Rp{{ number_format($item['user_last_bid']->bid_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
                <hr style="color: var(--bg-overlay-2); border-width:3px;">
                <div class="price-total">
                    <p>Current Bid :
                        <strong>Rp{{ number_format($item['latest_bid']->bid_price, 0, ',', '.') }}</strong>
                    </p>
                </div>
                <div class="order-footer-btn">
                    <div class="date-info">
                        <p style="color: var(--text-primary)">End Auctions in</p>
                        <input type="hidden" class="product-id" value="{{ $item['product']->product_id }}">
                        <div class="countdown" data-end-date="{{ $item['product']->productAuction->end_date }}">
                            <span class="countdown-timer" style="color:var(--primary)"></span>
                        </div>
                    </div>
                    <div class="group-button">
                        <a href="{{ route('front.auctionDetails', $item['product']->product_id) }}"
                            class="btn btn-outline-primary custom-btn">View
                            Product</a>

                        @if ($status != 'ON GOING')
                            <button disabled class="btn btn-primary" data-bs-toggle="modal" data-bs-target=""
                                data-bs-dismiss="modal">Bid
                                Again</button>
                        @else
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $item['product']->product_id }}"
                                data-bs-dismiss="modal">Bid
                                Again</button>
                        @endif

                        @if ($status != 'ON GOING' && $item['latest_bid']->bid_price == $item['user_last_bid']->bid_price)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=""
                                data-bs-dismiss="modal">Checkout</button>
                        @endif
                    </div>
                    {{-- {{ dd($productsWithBids) }} --}}
                    <div class="modal fade" id="exampleModal{{ $item['product']->product_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel{{ $item['product']->product_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="header-text">
                                        <p class="modal-title" id="exampleModalLabel{{ $item['product']->product_id }}"
                                            style="font-size:20px; font-weight:600">Place Your New Bid</p>
                                        <p style="font-size: 14px; font-weight:400">Enter Your Bid and See What Happens!</p>
                                    </div>
                                    <button style="background: transparent; border:none" data-bs-dismiss="modal"><svg width="32" height="32"
                                            viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.53464 25.3327L6.66797 23.466L14.1346 15.9993L6.66797 8.53268L8.53464 6.66602L16.0013 14.1327L23.468 6.66602L25.3346 8.53268L17.868 15.9993L25.3346 23.466L23.468 25.3327L16.0013 17.866L8.53464 25.3327Z"
                                                fill="#464646" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('front.bid.store') }}" method="post" style="width: 100%"
                                        class="form-auction">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['product']->product_id }}">
                                        <select class="buy-now bid-now-price" id="bid_price" name="bid_price"
                                            style="width: 100%">
                                            @foreach ($item['priceMultiples'] as $multiple)
                                                <option value="{{ $multiple }}">
                                                    Rp{{ number_format($multiple, 0, ',', '.') }}</option>
                                            @endforeach
                                        </select>
                                        @if ($item['product']->productAuction->status != 'ON GOING')
                                            <button type="submit" class="btn btn-primary buy-now" style="width: 100%"
                                                disabled>BID</button>
                                        @else
                                            <button type="submit" class="btn btn-primary buy-now"
                                                style="width: 100%">BID</button>
                                        @endif
                                    </form>
                                    <form action="{{ route('front.order.session', 'buy') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ json_encode([$item['product']->product_id]) }}"
                                            name="product">
                                        <input id="quantity2" type="number" step="1" max="10" value="1"
                                            name="quantity" class="quantity-field border-0 text-center inputcartnumber"
                                            hidden>
                                        @if ($item['product']->productAuction->status != 'ON GOING')
                                            <button type="submit" class="btn btn-primary buy-now" style="width: 100%"
                                                disabled>BUY NOW</button>
                                        @else
                                            <button type="submit" class="btn btn-primary buy-now"
                                                style="width: 100%">BUY NOW</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection

@push('after-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function startCountdown(element, targetDate) {
            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = new Date(targetDate).getTime() - now;

                if (distance < 0) {
                    element.innerHTML = "Auction ended";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                element.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            };

            updateCountdown();
            setInterval(updateCountdown, 1000);
        }

        $(document).ready(function() {
            $('.countdown').each(function() {
                const endDate = $(this).data('end-date');
                const countdownElement = $(this).find('.countdown-timer')[0];
                startCountdown(countdownElement, endDate);
            });
        });
    </script>
    <script>
        // Modal Js
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
@endpush
