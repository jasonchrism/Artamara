@extends('layouts.Details')

@push('styles')
    @vite('resources/css/buyer/order/form.css')
@endpush

<div style="margin-top: 62px;">
    <!-- Update User Address -->
    <div class="d-flex justify-content-center update-address-container">
        <form action="{{ route('front.order.address.change') }}" method="post" id="update-address">
            @csrf
            @method('PUT')
            <input type="text" name="update-address-id" value="{{ old('update-address-id', $address->address_id) }}"
                hidden>
            <div class="form-add-container">
                <div class="add-address-title">
                    <p class="fw-bold">Update Address</p>
                </div>
                <div class="add-input-container">
                    <label class="address-label">Receiver Name</label>
                    <input name="update-receiver-name" value="{{ old('update-receiver-name', $address->receiver) }}"
                        type="text" class="form-control w-100 @error('update-receiver-name') is-invalid @enderror"
                        required>
                    @error('update-receiver-name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Phone Number</label>
                    <input name="update-phone-number" value="{{ old('update-phone-number', $address->phone_number) }}"
                        type="text" class="form-control w-100 @error('update-phone-number') is-invalid @enderror"
                        required>
                    @error('update-phone-number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Street</label>
                    <input name="update-street" value="{{ old('update-street', $address->street) }}" type="text"
                        class="form-control w-100 @error('update-street') is-invalid @enderror" required>
                    @error('update-street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">City</label>
                    <input name="update-city" value="{{ old('update-city', $address->city) }}" type="text"
                        class="form-control w-100 @error('update-city') is-invalid @enderror" required>
                    @error('update-city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">District</label>
                    <input name="update-district" value="{{ old('update-district', $address->district) }}"
                        type="text" class="form-control w-100 @error('update-district') is-invalid @enderror"
                        required>
                    @error('update-district')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Zip Code</label>
                    <input name="update-zip-code" value="{{ old('update-zip-code', $address->postal_code) }}"
                        type="text" class="form-control w-100 @error('update-zip-code') is-invalid @enderror"
                        required>
                    @error('update-zip-code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Province</label>
                    <input name="update-province" value="{{ old('update-province', $address->province) }}"
                        type="text" class="form-control w-100 @error('update-province') is-invalid @enderror"
                        required>
                    @error('update-province')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Country</label>
                    <select name="update-country" id="country"
                        class="form-control w-100 @error('update-country') is-invalid @enderror">
                        @foreach ($countries as $country)
                            <option value="{{ $country }}" {{ $address->country == $country ? 'selected' : '' }}
                                class="add-address-country">{{ $country }}</option>
                        @endforeach
                    </select>
                    @error('update-country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="add-input-container">
                    <label class="address-label">Description</label>
                    <textarea name="update-description"
                        class="form-control w-100 add-address-description @error('update-description') is-invalid @enderror">{{ old('update-description', $address->description) }}</textarea>
                    @error('update-description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center submit-add-address-container">
                    <button type="submit" class="btn btn-primary submit-update-address-btn fw-semibold">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
