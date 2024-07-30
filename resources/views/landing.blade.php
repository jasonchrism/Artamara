@extends('layouts.app')
@section('content')
    <img src="assets/Vector.png" class="vector" alt="">
    <img src="assets/Vector2.png" class="vector2" alt="">

    {{-- Hero --}}
    <section class="hero  justify-content-center gap-148 p-80 align-items-center">
        <img src="assets/hero.png" alt="">
        <div class="desc d-flex flex-column">
            <div class="d-flex flex-column gap-4 mb-32">
                <h1>Support Your<br>
                    Local Artist .</h1>
                <p>Discover and support local artists in your <br>
                    community. Find the perfect piece of <br>
                    art for your home or office.</p>
            </div>
            <button class="btn btn-primary">View Collections</button>
        </div>
    </section>

    {{-- Best Artist --}}
    <section class="d-flex flex-column justify-content-between p-80">
        <div class="item-desc d-flex justify-content-between w-100 align-items-center">
            <div class="d-flex flex-column gap-4 mb-32">
                <h2>Artwork From Best Artist.</h2>
                <p>Discover and support local artists in your <br>
                    community. Find the perfect piece of <br>
                    art for your home or office.</p>
            </div>
            <h3>View more</h3>
        </div>
        <div class="row align-items-center" data-masonry='{"percentPosition": true }'>
            @foreach ($products as $p)
                <div class="col-md-3 mb-3">
                    <a href="/productDetails/{{ $p->product_id }}">
                        <div class="card">
                            <img src="{{ $p->thumbnail }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $p->title }}</h5>
                                <p class="card-desc">{{ $p->user->name }}</p>
                                <p class="card-desc">{{ $p->year }}</p>
                                <h5 class="card-title" style="color: var(--primary); font-weight:400;">{{ $p->price }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </section>

    {{-- Discover Local Artist --}}
    <section class="hero d-flex justify-content-center gap-148 p-80 align-items-center">
        <img src="assets/discover.png" alt="">
        <div class="desc d-flex flex-column">
            <div class="d-flex flex-column gap-1 mb-32">
                <h2>Discover Local Artist .</h2>
                <p>
                    Discovering local artists can unveil hidden gems <br>
                    in your community's vibrant cultural landscape.
                    .</p>
            </div>
            <button class="btn btn-primary">Explore Artist</button>
        </div>
    </section>

    {{-- Auctions --}}
    <section class="justify-content-between p-80    ">
        <div class="item-desc d-flex justify-content-between w-100 align-items-center">
            <div class="d-flex flex-column gap-4 mb-32">
                <h2>Artamara Auctions.</h2>
                <p>The local artist's artwork auction drew enthusiastic <br>
                    bidders, supporting community creativity .</p>
            </div>
            <h3>View more</h3>
        </div>
        <div class="row align-items-end w-100" data-masonry='{"percentPosition": true }'>
            @foreach ($auctions as $auction)
                <div class="col-md-2 mb-3">
                    <a href="/auctionDetails/{{ $auction->product_id }}">
                        <div class="card">
                            <img src="{{ $auction->thumbnail }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $auction->title }}</h5>
                                <p class="card-desc">{{ $auction->user->name }}</p>
                                <p class="card-desc">{{ $auction->year }}</p>
                                <h5 class="card-title" style="color: var(--primary); font-weight:400;">
                                    {{ 'Rp' . number_format(count($auction->productAuction->bid) == 0 ? $auction->start_price : $auction->productAuction->bid()->orderBy('bid_price', 'desc')->first()->bid_price, 0, ',', '.') }}
                                </h5>
                                <p class="card-desc"><span id="countdown-{{ $auction->product_id }}"></span></p>
                                <span class="end-date"
                                    style="display:none;">{{ $auction->productAuction->end_date }}</span>
                                <span class="start-date"
                                    style="display:none;">{{ $auction->productAuction->start_date }}</span>
                                <span class="status" style="display:none;">{{ $auction->productAuction->status }}</span>
                                <span class="product_id" style="display:none;">{{ $auction->product_id }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </section>
@endsection

@push('styles')
    @vite('resources/css/landing.css')
@endpush
@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Function to initialize countdown
            function initializeCountdown(productId, date, status) {
                var countdownElement = document.getElementById('countdown-' + productId);
                var dateTime = new Date(date).getTime();
                let preText = "";
                var countdownInterval = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = dateTime - now;
                    if (status === "STARTING SOON") {
                        preText = "Starts in ";
                    } else {
                        preText = "Ends in ";
                    }

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    countdownElement.innerHTML = preText + days + "d : " + hours + "h : " + minutes +
                        "m : " + seconds +
                        "s ";

                    if (distance < 0) {
                        clearInterval(countdownInterval);
                        countdownElement.innerHTML = "Ended";
                    }
                }, 1000);
            }

            // Initialize countdown for each product
            var products = document.querySelectorAll('.col-md-2');
            products.forEach(function(product) {
                var endDate = product.querySelector('.end-date').textContent;
                var startDate = product.querySelector('.start-date').textContent;
                var status = product.querySelector('.status').textContent;
                var productId = product.querySelector('.product_id').textContent;

                let date = null
                if (status === "STARTING SOON") {
                    date = startDate;
                } else {
                    date = endDate;
                }
                initializeCountdown(productId, date, status);
            });
        });
    </script>
@endpush
