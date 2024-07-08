@extends('layouts.Details')

@push('styles')
    @vite('resources/css/buyer/order/form.css')
@endpush

@section('content')
<div style="margin-top: 62px;">
    <!-- Update User Address -->
    <div class="d-flex justify-content-center create-address-container">
        <form action="{{route('front.order.address.store')}}" method="post" id="add-new-address">
            @csrf
            <div class="form-add-container">
                <div class="add-address-title">
                    <p class="fw-bold">
                        Add New Address
                    </p>
                </div>
                <div class="add-input-container">
                    <label class="address-label">Receiver Name</label>
                    <input name="receiver-name" type="text" value="{{old('receiver-name')}}" class="form-control w-100 @error('receiver-name') is-invalid @enderror">
                    @error('receiver-name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Phone Number</label>
                    <input name="phone-number" type="text" value="{{old('phone_number')}}" class="form-control w-100 @error('phone-number') is-invalid @enderror" required>
                    @error('phone-number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Street</label>
                    <input name="street" type="text" value="{{old('street')}}" class="form-control w-100 @error('street') is-invalid @enderror" required>
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">City</label>
                    <input name="city" type="text" value="{{old('city')}}" class="form-control w-100 @error('city') is-invalid @enderror" required>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">District</label>
                    <input name="district" type="text" value="{{old('district')}}" class="form-control w-100 @error('district') is-invalid @enderror" required>
                    @error('district')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Zip Code</label>
                    <input name="zip-code" type="text" value="{{old('zip-code')}}" class="form-control w-100 @error('zip-code') is-invalid @enderror" required>
                    @error('zip-code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Province</label>
                    <input name="province" type="text" value="{{old('province')}}" class="form-control w-100 @error('province') is-invalid @enderror" required>
                    @error('province')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Country</label>
                    <select name="country" id="country" class="form-control w-100 @error('country') is-invalid @enderror">
                        @foreach($countries as $country)
                        <option value={{$country}} class="add-address-country">{{ $country }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Description</label>
                    <textarea name="description" type="textarea" class="form-control w-100 add-address-description @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center submit-add-address-container">
                    <button type="submit" class="btn btn-primary submit-add-address-btn fw-semibold">
                        Add Address
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

