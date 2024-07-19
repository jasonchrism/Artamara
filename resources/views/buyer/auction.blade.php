@section('title')
    Auction
@endsection
@extends('layouts.app')
@push('styles')
    @vite('resources/css/buyer/catalog.css')
@endpush


@section('content')
    <div class="container-catalog">
        <h4 class="text-white fw-semibold">Browse by Category</h4>
        <div class="d-flex wrap-category">
            <a href="{{route('front.auction.category', 'Realism')}}" class="col category-content">
                <img src="assets/category1.png" class="category-img" alt="">
                <p class="d-inline">Realism</p>
            </a>
            <a href="{{route('front.auction.category', 'Photorealism')}}" class="col category-content">
                <img src="assets/category2.png" class="category-img" alt="">
                <p class="d-inline">Photorealism</p>
            </a>
            <a href="{{route('front.auction.category', 'Expressionism')}}" class="col category-content">
                <img src="assets/category3.png" class="category-img" alt="">
                <p class="d-inline">Expressionism</p>
            </a>
            <a href="{{route('front.auction.category', 'Impressionism')}}" class="col category-content">
                <img src="assets/category4.png" class="category-img" alt="">
                <p class="d-inline">Impressionism</p>
            </a>
            <a href="{{route('front.auction.category', 'Abstract')}}" class="col category-content">
                <img src="assets/category5.png" class="category-img" alt="">
                <p class="d-inline">Abstract</p>
            </a>
            <a href="{{route('front.auction.category', 'Surrealism')}}" class="col category-content">
                <img src="assets/category6.png" class="category-img" alt="">
                <p class="d-inline">Surrealism</p>
            </a>
            <a href="{{route('front.auction.category', 'Pop Art')}}" class="col category-content">
                <img src="assets/category7.png" class="category-img" alt="">
                <p class="d-inline">Pop Art</p>
            </a>
        </div>
        <div class="header-artworks">
            <h4 class="text-white fw-semibold mb-3">All Artworks</h4>
            <p class="mb-3">{{ number_format($count, 0, ',', '.') }} Artworks:</p>
        </div>
        <div class="row align-items-center" data-masonry='{"percentPosition": true }'>
            @foreach ($products as $product)
                <div class="col-md-3 mb-3">
                    {{-- ini untuk connect ke art details berdasarkan id product yang ditekan --}}
                    <a href="/auctionDetails/{{ $product->product_id }}">
                        <div class="card">
                            <img src="{{ $product->thumbnail }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->title }}</h5>
                                <p class="card-desc">{{ $product->user->name }}</p>
                                <p class="card-desc">{{ $product->year }}</p>
                                <h5 class="card-title" style="color: var(--primary); font-weight:400;">
                                    {{ 'Rp' . number_format((count($product->productAuction->bid) == 0 ? $product->start_price : $product->productAuction->bid()->orderBy('bid_price', 'desc')->first()->bid_price), 0, ',', '.') }}</h5>
                                <p class="card-desc"><span id="countdown-{{ $product->product_id }}"></span></p>
                                <span class="end-date" style="display:none;">{{ $product->productAuction->end_date }}</span>
                                <span class="start-date" style="display:none;">{{ $product->productAuction->start_date }}</span>
                                <span class="status" style="display:none;">{{ $product->productAuction->status }}</span>
                                <span class="product_id" style="display:none;">{{ $product->product_id }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        {{ $products->onEachSide(5)->links() }}
    </div>
@endsection


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
                    if(status === "STARTING SOON"){
                        preText = "Starts in ";
                    }else{
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
            var products = document.querySelectorAll('.col-md-3');
            products.forEach(function(product) {
                var endDate = product.querySelector('.end-date').textContent;
                var startDate = product.querySelector('.start-date').textContent;
                var status = product.querySelector('.status').textContent;
                var productId = product.querySelector('.product_id').textContent;

                let date = null
                if(status === "STARTING SOON"){
                    date = startDate;
                }else{
                    date = endDate;
                }
                initializeCountdown(productId, date, status);
            });
        });
    </script>
@endpush
