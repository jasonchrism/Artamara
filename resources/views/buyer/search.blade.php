@section('title')
    Search
@endsection
@extends('layouts.app')
@push('styles')
    @vite('resources/css/buyer/catalog.css')
@endpush


@section('content')
    <div class="container-catalog">
        <div class="header-artworks">
            <h4 class="text-white fw-semibold mb-3">Artworks for "{{$query}}"</h4>
            <p class="mb-3">{{ number_format($count, 0, ',', '.') }} Artworks:</p>
        </div>
        <div class="row align-items-center" data-masonry='{"percentPosition": true }'>
            @foreach ($products as $product)
                <div class="col-md-3 mb-3">
                    {{-- ini untuk connect ke art details berdasarkan id product yang ditekan --}}
                    <a href="/productDetails/{{ $product->product_id }}">
                        <div class="card">
                            <img src="{{ $product->thumbnail }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->title }}</h5>
                                <p class="card-desc">{{ $product->user->name }}</p>
                                <p class="card-desc">{{ $product->year }}</p>
                                <h5 class="card-title" style="color: var(--primary); font-weight:400;">
                                    {{ 'Rp' . number_format($product->price, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        {{$products->onEachSide(5)->links()}}
    </div>
@endsection


@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
@endpush
