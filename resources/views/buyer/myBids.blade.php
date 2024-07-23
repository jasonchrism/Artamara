@vite('resources/css/buyer/myBids.css')
@vite('resources/css/buyer/productAuction.css')
@vite('resources/css/artist/transactions/transactionDetail.css')
@vite('resources/css/addressnotification.css')

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
                                    <button style="background: transparent; border:none" data-bs-dismiss="modal"><svg
                                            width="32" height="32" viewBox="0 0 32 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
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
                                        <select class="buy-now bid-now-price custom-select" id="bid_price" name="bid_price"
                                            style="width: 100%">
                                            @foreach ($item['priceMultiples'] as $multiple)
                                                <option value="{{ $multiple }}">
                                                    Rp{{ number_format($multiple, 0, ',', '.') }}
                                                </option>
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
                                                disabled>BUY
                                                NOW</button>
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
                @if (session('status') || session('bid_price') || $errors->any())
                    <div class="notification {{ session('status') == 'error' ? 'error' : '' }}" id="notifBids">
                        <div class="d-flex notif-container">
                            @if ($errors->any())
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 16.4167C11.3069 16.4167 11.5644 16.3127 11.7724 16.1047C11.9804 15.8967 12.084 15.6396 12.0833 15.3334C12.0826 15.0271 11.9786 14.77 11.7713 14.562C11.564 14.354 11.3069 14.25 11 14.25C10.693 14.25 10.4359 14.354 10.2286 14.562C10.0213 14.77 9.91735 15.0271 9.91663 15.3334C9.9159 15.6396 10.0199 15.897 10.2286 16.1058C10.4373 16.3145 10.6945 16.4181 11 16.4167ZM9.91663 12.0834H12.0833V5.58335H9.91663V12.0834ZM11 21.8334C9.50135 21.8334 8.09302 21.5488 6.77496 20.9797C5.45691 20.4106 4.31038 19.6389 3.33538 18.6646C2.36038 17.6903 1.58868 16.5438 1.02029 15.225C0.451905 13.9062 0.16735 12.4979 0.166627 11C0.165905 9.50213 0.450461 8.0938 1.02029 6.77502C1.59013 5.45624 2.36182 4.30972 3.33538 3.33544C4.30893 2.36116 5.45546 1.58947 6.77496 1.02035C8.09446 0.451243 9.50279 0.166687 11 0.166687C12.4971 0.166687 13.9055 0.451243 15.225 1.02035C16.5445 1.58947 17.691 2.36116 18.6645 3.33544C19.6381 4.30972 20.4102 5.45624 20.9807 6.77502C21.5513 8.0938 21.8355 9.50213 21.8333 11C21.8311 12.4979 21.5466 13.9062 20.9796 15.225C20.4127 16.5438 19.641 17.6903 18.6645 18.6646C17.6881 19.6389 16.5416 20.4109 15.225 20.9808C13.9083 21.5506 12.5 21.8348 11 21.8334ZM11 19.6667C13.4194 19.6667 15.4687 18.8271 17.1479 17.1479C18.827 15.4688 19.6666 13.4195 19.6666 11C19.6666 8.58058 18.827 6.53127 17.1479 4.8521C15.4687 3.17294 13.4194 2.33335 11 2.33335C8.58052 2.33335 6.53121 3.17294 4.85204 4.8521C3.17288 6.53127 2.33329 8.58058 2.33329 11C2.33329 13.4195 3.17288 15.4688 4.85204 17.1479C6.53121 18.8271 8.58052 19.6667 11 19.6667Z"
                                        fill="#FC2D2D" />
                                </svg>
                                <p class="title fw-semibold">{{ $errors->first() }}</p>
                            @else
                                <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 2.16669C7.04163 2.16669 2.16663 7.04169 2.16663 13C2.16663 18.9584 7.04163 23.8334 13 23.8334C18.9583 23.8334 23.8333 18.9584 23.8333 13C23.8333 7.04169 18.9583 2.16669 13 2.16669ZM13 21.6667C8.22246 21.6667 4.33329 17.7775 4.33329 13C4.33329 8.22252 8.22246 4.33335 13 4.33335C17.7775 4.33335 21.6666 8.22252 21.6666 13C21.6666 17.7775 17.7775 21.6667 13 21.6667ZM17.9725 8.21169L10.8333 15.3509L8.02746 12.5559L6.49996 14.0834L10.8333 18.4167L19.5 9.75002L17.9725 8.21169Z"
                                        fill="#CEFE06" />
                                </svg>

                                <p class="title fw-semibold">{{ session('bid_price') }}</p>
                            @endif
                        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notif = document.getElementById('notifBids');
            if (notif) {
                setTimeout(() => {
                    notif.style.display = 'none';
                }, 1000); // Hide after 5 seconds
            }
        });
    </script>
@endpush
