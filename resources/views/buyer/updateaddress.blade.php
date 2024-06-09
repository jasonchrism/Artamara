@vite('resources/css/tabprofile.css')
@extends('layouts.app')

@section('content')
<div style="margin-top: 62px;">
    <ul class="nav nav-pills" id="myTab">
        <li class="nav-item tab-link">
            <a class="" href="/myprofile">Profile</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="/myprofile/password">Change Password</a>
        </li>
        <li class="nav-item tab-link tab-active">
            <a class="" href="/myaddress">Address</a>
        </li>
    </ul>
        
        <!-- Update User Address -->
        <div class="d-flex justify-content-center update-address-container">
            <form action="{{ route('front.myaddress.update') }}" method="post" id="update-address" class="form-add-container">
                @csrf
                @method('PUT')
                <input type="text" name="update-address-id" value="{{ old('update-address-id', $address->address_id) }}" hidden>
                <div class="form-add-container">
                    <div class="add-address-title">
                        <p class="fw-bold">Update Address</p>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Receiver Name</label>
                        <input name="update-receiver-name" value="{{ old('update-receiver-name', $address->receiver) }}" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Phone Number</label>
                        <input name="update-phone-number" value="{{ old('update-phone-number', $address->phone_number) }}" type="text" class="form-control w-100 @error('update-phone-number') is-invalid @enderror" required>
                        @error('update-phone-number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Street</label>
                        <input name="update-street" value="{{ old('update-street', $address->street) }}" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">City</label>
                        <input name="update-city" value="{{ old('update-city', $address->city) }}" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">District</label>
                        <input name="update-district" value="{{ old('update-district', $address->district) }}" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Zip Code</label>
                        <input name="update-zip-code" value="{{ old('update-zip-code', $address->postal_code) }}" type="text" class="form-control w-100 @error('update-zip-code') is-invalid @enderror" required>
                        @error('update-zip-code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Province</label>
                        <input name="update-province" value="{{ old('update-province', $address->province) }}" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Country</label>
                        <select name="update-country" id="country" class="form-control w-100">
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ $address->country == $country ? 'selected' : '' }} class="add-address-country">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Description</label>
                        <textarea name="update-description" class="form-control w-100 add-address-description">{{ old('update-description', $address->description) }}</textarea>
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

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        document.querySelector('input[name="update-address-id"]').value = address.address_id;
        document.querySelector('input[name="update-receiver-name"]').value = address.receiver;
        document.querySelector('input[name="update-phone-number"]').value = address.phone_number;
        document.querySelector('input[name="update-street"]').value = address.street;
        document.querySelector('input[name="update-city"]').value = address.city;
        document.querySelector('input[name="update-district"]').value = address.district;
        document.querySelector('input[name="update-zip-code"]').value = address.postal_code;
        document.querySelector('input[name="update-province"]').value = address.province;
        document.querySelector('select[name="update-country"]').value = address.country;
        document.querySelector('textarea[name="update-description"]').value = address.description;
    });
</script>

@endsection