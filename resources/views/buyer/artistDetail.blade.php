@section('title')
    Artist Detail
@endsection
@extends('layouts.app')
@push('styles')
    @vite('resources/css/buyer/catalog.css')
@endpush


@section('content')
    <div class="container-catalog">
        <div class="wrap-head p-4">
            <div class="d-flex align-items-center">
                <img src="/assets/art2.jpg" alt="" class="object-fit-cover" style="width: 213px; height:213px">
                <div class="head-right">
                    <h2 class="text-white mb-2">{{ $artist->name }}</h2>
                    <div class="d-flex mb-2">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.21886 17.526L12.5001 15.5468L15.7814 17.552L14.922 13.802L17.8126 11.302L14.0105 10.9635L12.5001 7.42183L10.9897 10.9375L7.18761 11.276L10.0782 13.802L9.21886 17.526ZM7.63032 19.7114L8.92199 14.177L4.6272 10.4562L10.2845 9.96662L12.5001 4.74683L14.7157 9.96558L20.372 10.4552L16.0772 14.176L17.3699 19.7104L12.5001 16.7729L7.63032 19.7114Z"
                                fill="#CEFE06" />
                        </svg>
                        <p class="ms-2">Rating: <span class="rate">{{number_format($avgRating, 1)}} / 5</span></p>
                    </div>
                    <p class="artist-desc">{{ $artist->about }}</p>
                </div>
            </div>
        </div>
        <div class="wrap-tab">
            <a href="artworks" class="tab {{ $tabs == 'artworks' ? 'active' : '' }}">Artworks</a>
            <a href="reviews" class="tab {{ $tabs == 'reviews' ? 'active' : '' }}">Reviews</a>
        </div>
        @if ($tabs == 'artworks')
            <p class="mb-3">{{ number_format($products->count(), 0, ',', '.') }} Artworks:</p>
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
            {{ $products->onEachSide(5)->links() }}
        @else
            <div class="wrap-review">
                @forelse ($reviews as $review)
                    <div class="card-review text-center">
                        <img src="/assets/art2.jpg" alt="" class="object-fit-cover rounded-circle mb-2"
                            style="width: 30px; height:30px">
                        <p class="text-white mb-2">{{ $review->order->user->name }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8002 22.434L16.0002 19.9007L20.2002 22.4673L19.1002 17.6673L22.8002 14.4673L17.9335 14.034L16.0002 9.50066L14.0669 14.0007L9.20019 14.434L12.9002 17.6673L11.8002 22.434ZM9.76685 25.2313L11.4202 18.1473L5.92285 13.3847L13.1642 12.758L16.0002 6.07666L18.8362 12.7567L26.0762 13.3833L20.5789 18.146L22.2335 25.23L16.0002 21.47L9.76685 25.2313Z"
                                        fill="#CEFE06" />
                                    <path
                                        d="M9.825 25L11.45 17.975L6 13.25L13.2 12.625L16 6L18.8 12.625L26 13.25L20.55 17.975L22.175 25L16 21.275L9.825 25Z"
                                        fill="#CEFE06" />
                                </svg>
                            @endfor
                            @for ($i = 0; $i < 5 - $review->rating; $i++)
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8002 22.434L16.0002 19.9007L20.2002 22.4673L19.1002 17.6673L22.8002 14.4673L17.9335 14.034L16.0002 9.50066L14.0669 14.0007L9.20019 14.434L12.9002 17.6673L11.8002 22.434ZM9.76685 25.2313L11.4202 18.1473L5.92285 13.3847L13.1642 12.758L16.0002 6.07666L18.8362 12.7567L26.0762 13.3833L20.5789 18.146L22.2335 25.23L16.0002 21.47L9.76685 25.2313Z"
                                        fill="#CEFE06" />
                                </svg>
                            @endfor
                        </div>
                        <p class="review-desc text-truncate-multiline">{{ $review->comment }}</p>
                    </div>
                @empty
                    <p class="text-secondary-txt">No Reviews</p>
                @endforelse

            </div>
        @endif

    </div>
@endsection


@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
@endpush
