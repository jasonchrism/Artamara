@vite('resources/css/artist/rating.css')
@extends('layouts.Details')
@section('content')
@include('includes.headerLogo')

<div class="rating-details-container">
    <div class="header d-flex">
        <div class="back-btn">
            <a href="{{ route('rating.index') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.26904 11.9984L8.23384 5.03204L9.36664 6.16324L4.33144 11.1984L22.4002 11.1984L22.4002 12.7984L4.33144 12.7984L9.36664 17.832L8.23384 18.9648L1.26904 11.9984Z" fill="#FDFFF3" />
                </svg>
            </a>
        </div>
        <p class="fw-semibold text-white header-title">Rating Details</p>
    </div>
    @foreach($orders as $or)
    <div class="bottom-container d-flex">
        <div class="l-side">
            <div class="order-id-container" style="margin-bottom: 16px;">
                <p class="text-white fw-semibold order-id marb-4">Order ID</p>
                <p class="text-white marb-4">{{ $or->order_id }}</p>
            </div>
            <div class="product-details-container">
                <p class="text-white fw-semibold marb-4">Product Details</p>
                @foreach($or->orderDetail as $od)
                <div class="product-container d-flex justify-content-between">
                    <div class="product-subcontainer d-flex">
                        <img src="https://placehold.co/400x400/png" alt="" style="width: 45px; height: 45px;">
                        <div class="product-name-container d-flex flex-column">
                            <p class="text-white marb-4">{{ $od->product->title }}</p>
                            <p class="text-secondary marb-4">{{ $od->quantity }}x</p>
                        </div>
                    </div>
                    <div class="product-price-container d-flex justify-content-center align-items-center">
                        <p class="text-white fw-semibold marb-4">Rp{{ $od->product->price }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="r-side">
            <div class="buyer-container" style="margin-bottom: 16px;">
                <p class="text-white fw-semibold marb-4">Buyer</p>
                <p class="text-white marb-4">{{ $or->user->username }}</p>
            </div>
            <div class="rating-container" style="margin-bottom: 16px;">
                <p class="text-white fw-semibold marb-4">Rating</p>
                <div class="form-group row">
                <div class="col">
                    <div class="rate">
                        <input disabled type="radio" {{ optional($or->review)->rating == 5 ? 'checked' : '' }} id="star5" class="rate" name="rating" value="5" />
                        <label for="star5"  title="text">5 stars</label>
                        <input disabled type="radio" {{ optional($or->review)->rating == 4 ? 'checked' : '' }} id="star4" class="rate" name="rating" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input disabled type="radio" {{ optional($or->review)->rating == 3 ? 'checked' : '' }} id="star3" class="rate" name="rating" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input disabled type="radio" {{ optional($or->review)->rating == 2 ? 'checked' : '' }} id="star2" class="rate" name="rating" value="2">
                        <label for="star2" title="text">2 stars</label>
                        <input disabled type="radio" {{ optional($or->review)->rating == 1 ? 'checked' : '' }} id="star1" class="rate" name="rating" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                </div>
            </div>
            </div>
            <div class="comment-container" style="margin-bottom: 16px;">
                <p class="text-white fw-semibold marb-4">Comment</p>
                <p class="text-white marb-4">{{ $or->review->comment }}</p>
            </div>
            <div class="uploaded-container" style="margin-bottom: 16px;">
                <p class="text-white fw-semibold marb-4">Uploaded at</p>
                <p class="text-white marb-4">{{ $or->review->created_at->format('d F Y, H:i:s') }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection