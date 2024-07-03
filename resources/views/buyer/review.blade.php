@vite('resources/css/buyer/review.css')
@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center">
    <div class="review-container">
        <p class="review-title fw-semibold">Product Review</p>
        <p class="review-subtitle">Love It? Let Everyone Know! Write a Review</p>

        <div class="profile-container d-flex align-items-center">
            <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="" class="profile-picture">
            <p>{{ Auth::user()->username }}</p>
        </div>

        <div class="product-container">
            <p class="fw-semibold text-white product-container-title">Product Details</p>
            <div class="d-flex product-subcontainer justify-content-between align-items-center">
                <div class="d-flex">
                    <img src="https://placehold.co/600x400/000000/FFFFFF.png" alt="" class="product-image">
                    <div class="name-quantity">
                        <p class="m-0">Mountain Bird</p>
                        <p class="m-0">1x</p>
                    </div>
                </div>
                <p class="product-price fw-semibold">Rp200.000.000</p>
            </div>

            <div class="d-flex product-subcontainer justify-content-between align-items-center">
                <div class="d-flex">
                    <img src="https://placehold.co/600x400/000000/FFFFFF.png" alt="" class="product-image">
                    <div class="name-quantity">
                        <p class="m-0">Mountain Bird</p>
                        <p class="m-0">1x</p>
                    </div>
                </div>
                <p class="product-price fw-semibold">Rp200.000.000</p>
            </div>
        </div>

        <form class="py-2 px-4" action="" method="POST" autocomplete="off">
            @csrf
            <p class="fw-semibold" style="margin-left: 8px; font-size: 14px;">Rating</p>
            <div class="form-group row">
                <div class="col">
                    <div class="rate">
                        <input type="radio" id="star5" class="rate" name="rating" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" checked id="star4" class="rate" name="rating" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" class="rate" name="rating" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" class="rate" name="rating" value="2">
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" class="rate" name="rating" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                </div>
            </div>
        </form>

        <div class="comment-container">
            <p class="text-white fw-semibold" style="font-size: 14px; margin-bottom: 8px;">Reviews</p>
            <textarea name="review" id="review" placeholder="write a review" class="form-control"></textarea>
        </div>

        <div class="submit-btn-container d-flex justify-content-end">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</div>

@endsection