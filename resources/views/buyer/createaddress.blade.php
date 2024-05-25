@vite('resources/css/tabprofile.css')
@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-center">
        <form action="" class="form-add-container">
            <div class="form-add-container">
                <div class="add-address-title">
                    <p class="fw-bold">
                        Add New Address
                    </p>
                </div>
                <div class="add-input-container">
                    <label class="address-label">Name Receiver</label>
                    <input name="receiver-name" type="text" class="form-control w-100">
                </div>
                <div class="add-input-container">
                    <label class="address-label">Phone Number</label>
                    <input name="phone-number" type="text" class="form-control w-100">
                </div>
                <div class="add-input-container">
                    <label class="address-label">Street</label>
                    <input name="street" type="text" class="form-control w-100">
                </div>
                <div class="add-input-container">
                    <label class="address-label">City</label>
                    <input name="city" type="text" class="form-control w-100">
                </div>
                <div class="add-input-container">
                    <label class="address-label">District</label>
                    <input name="district" type="text" class="form-control w-100">
                </div>
                <div class="add-input-container">
                    <label class="address-label">Zip Code</label>
                    <input name="zip-code" type="text" class="form-control w-100">
                </div>
                <div class="add-input-container">
                    <label class="address-label">Province</label>
                    <input name="province" type="text" class="form-control w-100">
                </div>
                <div class="add-input-container">
                    <label class="address-label">Country</label>
                    <select name="country" id="country" class="form-control w-100">
                        @foreach($countries as $country)
                            <option value={{$country}} class="add-address-country">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-input-container">
                    <label class="address-label">Description</label>
                    <textarea name="description" type="textarea" class="form-control w-100 add-address-description"></textarea>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary submit-address-btn fw-semibold" onclick="addNewAddress()">
                        Add Address
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection