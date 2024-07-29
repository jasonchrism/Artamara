@vite('resources/css/buyer/review.css')
@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center">
    <div class="review-container">
        <p class="review-title fw-semibold">Product Review</p>
        <p class="review-subtitle">Love It? Let Everyone Know! Write a Review</p>

        <form class="" action="{{ route('front.buyer.store.review') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="order_id" value="{{$order->order_id}}">
            @foreach($groupedProducts as $userId => $products)
            <div class="profile-container d-flex align-items-center">
                <img src="{{ $products->first()->product->profile_picture }}" alt="" class="profile-picture">
                <p>{{ $products->first()->product->user->username }}</p>
            </div>

            <div class="product-container">
                <p class="fw-semibold text-white product-container-title">Product Details</p>
                @foreach($products as $orderDetail)
                <div class="d-flex product-subcontainer justify-content-between align-items-center">
                    <div class="d-flex">
                        <img src="{{ $orderDetail->product->thumbnail }}" alt="" class="product-image">
                        <div class="name-quantity">
                            <p class="m-0">{{ $orderDetail->product->title }}</p>
                            <p class="m-0">{{ $orderDetail->quantity }}x</p>
                        </div>
                    </div>
                    <p class="product-price fw-semibold">Rp{{ $orderDetail->product->price }}</p>
                </div>
                @endforeach
            </div>

            <p class="fw-semibold" style="margin-left: 32px; font-size: 14px;">Rating</p>
            <input type="hidden" name="reviews[{{ $orderDetail->product->product_id }}][order_id]" value="{{ $order->order_id }}">
            <div class="form-group row">
                <div class="col">
                    <div class="rate">
                        <input type="hidden" name="reviews[{{ $orderDetail->product->product_id }}][artist_id]" value="{{ $orderDetail->product->user->user_id }}">
                        @for($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}_{{ $orderDetail->product->product_id }}" class="rate" {{ $i == 4 ? 'checked' : '' }} name="reviews[{{ $orderDetail->product->product_id }}][rating]" value="{{ $i }}" />
                        <label for="star{{ $i }}_{{ $orderDetail->product->product_id }}" title="{{ $i }} stars">{{ $i }} stars</label>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="comment-container">
                <p class="text-white fw-semibold" style="font-size: 14px; margin-bottom: 8px;">Reviews</p>
                <textarea name="reviews[{{ $orderDetail->product->product_id }}][comment]" id="review" placeholder="write a review" class="form-control"></textarea>
            </div>

            @endforeach

            <div class="submit-btn-container d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rateElements = document.querySelectorAll('.rate');

        rateElements.forEach(rate => {
            const inputs = rate.querySelectorAll('input');
            const labels = rate.querySelectorAll('label');

            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    const value = this.value;

                    labels.forEach(label => {
                        if (label.htmlFor.split('_')[1] === rate.className.split('-')[1]) {
                            label.style.color = (label.htmlFor === `star${value}_${rate.className.split('-')[1]}` || label.htmlFor.split('_')[0].replace('star', '') <= value) ? 'var(--primary)' : '#ccc';
                        }
                    });
                });
            });

            labels.forEach(label => {
                label.addEventListener('mouseover', function() {
                    const value = this.htmlFor.split('_')[0].replace('star', '');

                    labels.forEach(l => {
                        if (l.htmlFor.split('_')[1] === rate.className.split('-')[1]) {
                            l.style.color = (l.htmlFor.split('_')[0].replace('star', '') <= value) ? 'var(--primary)' : '#ccc';
                        }
                    });
                });

                label.addEventListener('mouseout', function() {
                    const checkedInput = rate.querySelector('input:checked');
                    const value = checkedInput ? checkedInput.value : 0;

                    labels.forEach(l => {
                        if (l.htmlFor.split('_')[1] === rate.className.split('-')[1]) {
                            l.style.color = (l.htmlFor.split('_')[0].replace('star', '') <= value) ? 'var(--primary)' : '#ccc';
                        }
                    });
                });
            });
        });
    });
</script>

@endsection