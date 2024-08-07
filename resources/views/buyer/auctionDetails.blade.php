@extends('layouts.app')

@push('styles')
    @vite('resources/css/buyer/productAuction.css')
    @vite('resources/css/addressnotification.css')
@endpush

@section('content')
    {{-- {{dd($product->product)}} --}}
    <div class="container Product-Details-Container">

        {{-- ini untuk bagian atas --}}
        <div class="row Upper-details-container">

            {{-- ini untuk foto-foto carousel --}}
            <div class="col-md-6 product-photos">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach (json_decode($product->product->photo) as $index => $photo)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner">
                        @foreach (json_decode($product->product->photo) as $index => $photo)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url($photo) }}" alt="no img right now" class="product-photo">
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            {{-- ini bagian kanan, atas --}}
            <div class="col-md-6 product-detail-right">
                <p style="font-size: 24px; font-weight:500;">{{ $product->product->title }}</p>
                <p style="font-size: 24px; font-weight:500; color: var(--text-secondary);">
                    {{ $product->product->user->name }},
                    {{ $product->product->year }}</p>
                <p style="font-size: 14px; font-weight:500; color: var(--text-secondary); padding-bottom:16px;"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.8125 12.75C11.8125 12.8992 11.7532 13.0423 11.6477 13.1477C11.5423 13.2532 11.3992 13.3125 11.25 13.3125H6.75C6.60082 13.3125 6.45774 13.2532 6.35225 13.1477C6.24676 13.0423 6.1875 12.8992 6.1875 12.75C6.1875 12.6008 6.24676 12.4577 6.35225 12.3523C6.45774 12.2468 6.60082 12.1875 6.75 12.1875H11.25C11.3992 12.1875 11.5423 12.2468 11.6477 12.3523C11.7532 12.4577 11.8125 12.6008 11.8125 12.75ZM11.25 9.1875H6.75C6.60082 9.1875 6.45774 9.24676 6.35225 9.35225C6.24676 9.45774 6.1875 9.60082 6.1875 9.75C6.1875 9.89918 6.24676 10.0423 6.35225 10.1477C6.45774 10.2532 6.60082 10.3125 6.75 10.3125H11.25C11.3992 10.3125 11.5423 10.2532 11.6477 10.1477C11.7532 10.0423 11.8125 9.89918 11.8125 9.75C11.8125 9.60082 11.7532 9.45774 11.6477 9.35225C11.5423 9.24676 11.3992 9.1875 11.25 9.1875ZM21.5625 15.0581V21C21.5627 21.0989 21.5369 21.196 21.4876 21.2817C21.4384 21.3674 21.3674 21.4386 21.2818 21.4881C21.1963 21.5376 21.0992 21.5637 21.0003 21.5638C20.9015 21.5639 20.8044 21.5379 20.7188 21.4884L18.375 20.1478L16.0312 21.4884C15.9456 21.5379 15.8485 21.5639 15.7497 21.5638C15.6508 21.5637 15.5537 21.5376 15.4682 21.4881C15.3826 21.4386 15.3116 21.3674 15.2624 21.2817C15.2131 21.196 15.1873 21.0989 15.1875 21V18.5625H3.75C3.4019 18.5625 3.06806 18.4242 2.82192 18.1781C2.57578 17.9319 2.4375 17.5981 2.4375 17.25V5.25C2.4375 4.9019 2.57578 4.56806 2.82192 4.32192C3.06806 4.07578 3.4019 3.9375 3.75 3.9375H20.25C20.5981 3.9375 20.9319 4.07578 21.1781 4.32192C21.4242 4.56806 21.5625 4.9019 21.5625 5.25V8.19187C22.0355 8.62992 22.4129 9.16099 22.671 9.75177C22.9291 10.3426 23.0624 10.9803 23.0624 11.625C23.0624 12.2697 22.9291 12.9074 22.671 13.4982C22.4129 14.089 22.0355 14.6201 21.5625 15.0581ZM18.375 8.0625C17.6704 8.0625 16.9816 8.27144 16.3958 8.66289C15.8099 9.05434 15.3533 9.61073 15.0837 10.2617C14.814 10.9127 14.7435 11.629 14.881 12.32C15.0184 13.0111 15.3577 13.6458 15.8559 14.1441C16.3542 14.6423 16.9889 14.9816 17.68 15.119C18.371 15.2565 19.0873 15.186 19.7383 14.9163C20.3893 14.6467 20.9457 14.1901 21.3371 13.6042C21.7286 13.0184 21.9375 12.3296 21.9375 11.625C21.9375 10.6802 21.5622 9.77403 20.8941 9.10593C20.226 8.43783 19.3198 8.0625 18.375 8.0625ZM15.1875 17.4375V15.0581C14.3667 14.2921 13.8481 13.257 13.726 12.141C13.6039 11.0249 13.8864 9.90213 14.5222 8.97678C15.1579 8.05143 16.1047 7.385 17.1902 7.09867C18.2758 6.81234 19.4281 6.92514 20.4375 7.41656V5.25C20.4375 5.20027 20.4177 5.15258 20.3826 5.11742C20.3474 5.08225 20.2997 5.0625 20.25 5.0625H3.75C3.70027 5.0625 3.65258 5.08225 3.61742 5.11742C3.58225 5.15258 3.5625 5.20027 3.5625 5.25V17.25C3.5625 17.2997 3.58225 17.3474 3.61742 17.3826C3.65258 17.4177 3.70027 17.4375 3.75 17.4375H15.1875ZM20.4375 15.8334C19.7956 16.1486 19.0901 16.3125 18.375 16.3125C17.6599 16.3125 16.9544 16.1486 16.3125 15.8334V20.0306L18.0938 19.0116C18.1793 18.9622 18.2763 18.9362 18.375 18.9362C18.4737 18.9362 18.5707 18.9622 18.6562 19.0116L20.4375 20.0306V15.8334Z"
                            fill="#A0A0A0" />
                    </svg>
                    Includes a Certificate of Authenticity</p>

                {{-- Countdown Timer --}}
                <div id="auction-message">
                    <input type="hidden" id="product-id" value="{{ $product->product->product_id }}">
                    @if ($product->status == 'STARTING SOON')
                        <div class="countdown" id="start-countdown" data-start-date="{{ $product->start_date }}">
                            Auction starts in: <span id="start-countdown-timer"></span>
                        </div>
                    @else
                        <div class="countdown" id="countdown" data-end-date="{{ $product->end_date }}">
                            Auction ends in: <span id="countdown-timer"></span>
                        </div>
                    @endif
                </div>


                {{-- {{dd($lastBid)}} --}}
                @if ($lastBid == null)
                    <div class="pricing">
                        <p class="pricing-status">Starting Price</p>
                        <p class="pricing-price">
                            Rp{{ number_format($product->start_price, 0, ',', '.') }}
                        </p>
                    </div>
                @else
                    <div class="pricing">
                        <p class="pricing-status">Current Bid</p>
                        <p class="pricing-price">
                            Rp{{ number_format($lastBid->bid_price, 0, ',', '.') }}
                        </p>
                    </div>
                @endif


                <p style="font-size: 14px; font-weight:400; color: var(--text-secondary);">
                    This auction exclude shipping
                    taxes and additional fees</p>

                <p
                    style="margin-top:16px;margin-bottom:12px;font-size: 14px; font-weight:400; color: var(--text-secondary);">
                    Place Bid</p>

                <div class="button-bottom">
                    {{-- {{dd($product)}} --}}
                    @if (Auth::check())
                        <form action="{{ route('front.bid.store') }}" method="post" style="width: 100%"
                            class="form-auction">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <select class="buy-now bid-now-price custom-select" id="bid_price" name="bid_price"
                                style="width: 100%">
                                @foreach ($priceMultiples as $multiple)
                                    <option value="{{ $multiple }}">Rp{{ number_format($multiple, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($product->status != 'ON GOING')
                                <button type="submit" class="btn btn-primary buy-now" style="width: 100%"
                                    disabled>BID</button>
                            @else
                                <button type="submit" class="btn btn-primary buy-now" style="width: 100%">BID</button>
                            @endif
                        </form>
                        <form action="{{ route('front.order.session', 'buy') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ json_encode([$product->product_id]) }}" name="product">
                            <input id="quantity2" type="number" step="1" max="10" value="1"
                                name="quantity" class="quantity-field border-0 text-center inputcartnumber" hidden>
                            @if ($product->status != 'ON GOING')
                                <button type="submit" class="btn btn-primary buy-now" style="width: 100%" disabled>BUY
                                    NOW</button>
                            @else
                                <button type="submit" class="btn btn-primary buy-now buy-now-hover" style="width: 100%;"
                                    data-price="Rp.{{ $product->product->price }}"> <span class="button-text">BUY
                                        NOW</span></button>
                            @endif
                        </form>
                    @else
                        <select class="buy-now bid-now-price custom-select" id="bid_price" name="bid_price"
                            style="width: 100%">
                            @foreach ($priceMultiples as $multiple)
                                <option value="{{ $multiple }}">Rp{{ number_format($multiple, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        <form action="{{ route('login') }}" method="get" style="width: 100%">
                            <button type="submit" class="btn btn-primary buy-now" style="width: 100%">BID</button>
                        </form>
                        <form action="{{ route('login') }}" method="get" style="width: 100%">
                            <button type="submit" class="btn btn-primary buy-now buy-now-hover" style="width: 100%;"
                                data-price="Rp.{{ $product->product->price }}"><span class="button-text">BUY
                                    NOW</span></button>
                        </form>
                    @endif

                    @if (session('status') || session('bid_price') || $errors->any())
                        @if ($errors->any())
                            <div class="notification-success  {{ session('status') == 'error' ? 'error' : '' }}"
                                id="notif">
                                <div class="d-flex notif-container">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11 16.4167C11.3069 16.4167 11.5644 16.3127 11.7724 16.1047C11.9804 15.8967 12.084 15.6396 12.0833 15.3334C12.0826 15.0271 11.9786 14.77 11.7713 14.562C11.564 14.354 11.3069 14.25 11 14.25C10.693 14.25 10.4359 14.354 10.2286 14.562C10.0213 14.77 9.91735 15.0271 9.91663 15.3334C9.9159 15.6396 10.0199 15.897 10.2286 16.1058C10.4373 16.3145 10.6945 16.4181 11 16.4167ZM9.91663 12.0834H12.0833V5.58335H9.91663V12.0834ZM11 21.8334C9.50135 21.8334 8.09302 21.5488 6.77496 20.9797C5.45691 20.4106 4.31038 19.6389 3.33538 18.6646C2.36038 17.6903 1.58868 16.5438 1.02029 15.225C0.451905 13.9062 0.16735 12.4979 0.166627 11C0.165905 9.50213 0.450461 8.0938 1.02029 6.77502C1.59013 5.45624 2.36182 4.30972 3.33538 3.33544C4.30893 2.36116 5.45546 1.58947 6.77496 1.02035C8.09446 0.451243 9.50279 0.166687 11 0.166687C12.4971 0.166687 13.9055 0.451243 15.225 1.02035C16.5445 1.58947 17.691 2.36116 18.6645 3.33544C19.6381 4.30972 20.4102 5.45624 20.9807 6.77502C21.5513 8.0938 21.8355 9.50213 21.8333 11C21.8311 12.4979 21.5466 13.9062 20.9796 15.225C20.4127 16.5438 19.641 17.6903 18.6645 18.6646C17.6881 19.6389 16.5416 20.4109 15.225 20.9808C13.9083 21.5506 12.5 21.8348 11 21.8334ZM11 19.6667C13.4194 19.6667 15.4687 18.8271 17.1479 17.1479C18.827 15.4688 19.6666 13.4195 19.6666 11C19.6666 8.58058 18.827 6.53127 17.1479 4.8521C15.4687 3.17294 13.4194 2.33335 11 2.33335C8.58052 2.33335 6.53121 3.17294 4.85204 4.8521C3.17288 6.53127 2.33329 8.58058 2.33329 11C2.33329 13.4195 3.17288 15.4688 4.85204 17.1479C6.53121 18.8271 8.58052 19.6667 11 19.6667Z"
                                            fill="#FC2D2D" />
                                    </svg>
                                    <p class="title fw-semibold">{{ $errors->first() }}</p>
                                @else
                                    <div class="notification {{ session('status') == 'error' ? 'error' : '' }}"
                                        id="notif">
                                        <div class="d-flex notif-container">
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


    </div>
    </div>

    {{-- ini untuk bagian bawah --}}
    <div class="details-container">
        <div class="Lower-details-container">

            <div class="Artwork-About">
                <h3>About The Artwork</h3>
                <div class="Artwork-About-Details">
                    <div class="detail-auction-product">
                        <p style="width: 100px">Description</p>
                        <p style="color: var(--text-secondary)">{{ $product->product->description }}</p>
                    </div>
                    <div class="detail-auction-product">
                        <p style="width: 100px">Materials</p>
                        <p style="color: var(--text-secondary)">{{ $product->product->material }}</p>
                    </div>
                    <div class="detail-auction-product">
                        <p style="width: 100px">Size</p>
                        <p style="color: var(--text-secondary)">{{ $product->product->length }} x
                            {{ $product->product->width }} cm</p>
                    </div>
                    <div class="detail-auction-product">
                        <p style="width: 100px">Medium</p>
                        <p style="color: var(--text-secondary)">{{ $product->product->medium }}</p>
                    </div>
                    <div class="detail-auction-product">
                        <p style="width: 100px">Category</p>
                        <p style="color: var(--text-secondary)">{{ $product->product->category->name }}</p>
                    </div>

                </div>
            </div>

            <div class="Artist-About">
                <h3>About The Artist</h3>
                <div class="Artist-About-Details">
                    <div class="Artist-About-Details-Pic">
                        @if ($product->product->user->profile_picture == '-')
                            <img class="image-profile" src="https://via.placeholder.com/800x600" alt="tet">
                        @else
                            <img class="image-profile" src="{{ Storage::url($product->product->user->profile_picture) }}"
                                alt="tet">
                        @endif
                    </div>

                    <div class="Artist-About-Details-Desc">
                        <p style="font-weight: 600;">{{ $product->product->user->name }}</p>
                        <p class="artist-about-description-text">{{ $product->product->user->about }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bidder-table">
            <div class="Artwork-About">
                <h3>Bidder List</h3>
                {{-- {{dd($bids)}} --}}
                @if ($bids != null)
                    <div class="Artwork-About-Details ">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Bid Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bids as $index => $bid)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ $bid->user->name }}</td>
                                        <td>Rp{{ number_format($bid->bid_price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="Artwork-About-Details-noBid">
                        <p>No bidder yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection

@push('after-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function startCountdown(element, targetDate, isStartCountdown) {
            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = new Date(targetDate).getTime() - now;

                if (distance < 0) {
                    if (isStartCountdown) {
                        // Change status to "ON GOING"
                        const productId = document.getElementById('product-id').value;
                        $.ajax({
                            url: '{{ route('front.auction.updateStatus') }}',
                            type: 'POST',
                            data: {
                                product_id: productId,
                                status: 'ON GOING',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    } else {
                        element.innerHTML = "Auction ended";
                        const productId = document.getElementById('product-id').value;
                        $.ajax({
                            url: '{{ route('front.auction.updateStatus') }}',
                            type: 'POST',
                            data: {
                                product_id: productId,
                                status: 'CLOSED',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                const countdownTimer = isStartCountdown ? document.getElementById('start-countdown-timer') : document
                    .getElementById('countdown-timer');
                countdownTimer.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            };

            updateCountdown();
            setInterval(updateCountdown, 1000);
        }

        $(document).ready(function() {
            const startCountdownElement = document.getElementById('start-countdown');
            const countdownElement = document.getElementById('countdown');
            const productId = document.getElementById('product-id').value;

            if (startCountdownElement) {
                const startDate = startCountdownElement.getAttribute('data-start-date');
                startCountdown(startCountdownElement, startDate, true);
            }

            if (countdownElement) {
                const endDate = countdownElement.getAttribute('data-end-date');
                startCountdown(countdownElement, endDate, false);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notif = document.getElementById('notif');
            if (notif) {
                setTimeout(() => {
                    notif.style.display = 'none';
                }, 1000); // Hide after 5 seconds
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.querySelector('.buy-now-hover');
            const buttonText = button.querySelector('.button-text');
            const originalText = buttonText.innerText;
            const priceText = button.getAttribute('data-price');

            button.addEventListener('mouseover', function() {
                buttonText.style.opacity = 0;
                buttonText.style.transform = 'scale(0.9)';
                setTimeout(function() {
                    buttonText.innerText = priceText;
                    buttonText.style.opacity = 1;
                    buttonText.style.transform = 'scale(1)';
                }, 200); // Match the transition duration
            });

            button.addEventListener('mouseout', function() {
                buttonText.style.opacity = 0;
                buttonText.style.transform = 'scale(0.9)';
                setTimeout(function() {
                    buttonText.innerText = originalText;
                    buttonText.style.opacity = 1;
                    buttonText.style.transform = 'scale(1)';
                }, 200); // Match the transition duration
            });
        });
    </script>
@endpush
