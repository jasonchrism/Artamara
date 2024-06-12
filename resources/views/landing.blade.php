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
            @foreach($products as $p)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ $p->thumbnail }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->title }}</h5>
                        <p class="card-desc">{{ $p->description }}</p>
                        <p class="card-desc">{{ $p->year }}</p>
                        <h5 class="card-title" style="color: var(--primary); font-weight:400;">{{ $p->price }}</h5>
                    </div>
                </div>
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
    <section class="justify-content-between p-80    " >
        <div class="item-desc d-flex justify-content-between w-100 align-items-center">
            <div class="d-flex flex-column gap-4 mb-32">
                <h2>Artamara Auctions.</h2>
                <p>The local artist's artwork auction drew enthusiastic <br>
                    bidders, supporting community creativity .</p>
            </div>
            <h3>View more</h3>
        </div>
        <div class="row align-items-end w-100" data-masonry='{"percentPosition": true }'>
            <div class="col-md-2 mb-3">
                <div class="card">
                    <img src="assets/art1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Sepi Penghujung</h5>
                        <p class="card-desc">Joko Pinurbo</p>
                        <p class="card-desc">2014</p>
                        <h5 class="card-title" style="color: var(--primary); font-weight:400;">Rp 120.000.000</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card">
                    <img src="assets/art2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Sepi Penghujung</h5>
                        <p class="card-desc">Joko Pinurbo</p>
                        <p class="card-desc">2014</p>
                        <h5 class="card-title" style="color: var(--primary); font-weight:400;">Rp 120.000.000</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card">
                    <img src="assets/art3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Sepi Penghujung</h5>
                        <p class="card-desc">Joko Pinurbo</p>
                        <p class="card-desc">2014</p>
                        <h5 class="card-title" style="color: var(--primary); font-weight:400;">Rp 120.000.000</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card">
                    <img src="assets/art4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Sepi Penghujung</h5>
                        <p class="card-desc">Joko Pinurbo</p>
                        <p class="card-desc">2014</p>
                        <h5 class="card-title" style="color: var(--primary); font-weight:400;">Rp 120.000.000</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card">
                    <img src="assets/art3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Sepi Penghujung</h5>
                        <p class="card-desc">Joko Pinurbo</p>
                        <p class="card-desc">2014</p>
                        <h5 class="card-title" style="color: var(--primary); font-weight:400;">Rp 120.000.000</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card">
                    <img src="assets/art4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Sepi Penghujung</h5>
                        <p class="card-desc">Joko Pinurbo</p>
                        <p class="card-desc">2014</p>
                        <h5 class="card-title" style="color: var(--primary); font-weight:400;">Rp 120.000.000</h5>
                    </div>
                </div>
            </div>
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
@endpush
