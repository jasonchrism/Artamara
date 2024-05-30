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

        <!-- View User Address List -->
        <div id="address" class="tab-name text-white view-address-list-container">
            <div class="d-flex justify-content-center">
                <div class="address-list-container">
                    <p class="d-flex justify-content-start view-address-title fw-bold">
                        Address Lists
                    </p>
                    <div class="loop-container">
                        @if($is_address_null == null) 
                            <p class="text-white text-center">No address available</p>
                        @endif
                        @foreach($user_addresses as $index => $address)
                        <div class="address-box" style="margin-top: {{ !$index == 0 ? '24px' : '' }};">
                            <div class="d-flex flex-column h-100  {{$address->is_default == 1 ? 'default-address' : ''}} ">
                                <div>
                                    <input type="text" name="delete-address-id" value="" hidden>
                                    <div class="d-flex address-name">
                                        <img src="/assets/location-icon.svg" alt="" class="me-2 location-icon">
                                        <p>{{ $address->receiver }} , {{ $address->phone_number }}</p>
                                    </div>
                                    <p class="address-detail">{{ $address['street'] }}, {{ $address['district'] }}, {{ $address['city'] }}, {{ $address['province'] }}, {{ $address['country'] }}, {{ $address['postal_code'] }}</p>
                                </div>
                                <div class="edit-btn-container mt-auto">
                                    @if ($address->is_default)
                                        <button class="edit-address-btn text-primary" onclick="updateAddress({{$address}})">
                                            Change address  
                                        </button>
                                        <button type="button" class="edit-address-btn text-primary" data-bs-toggle="modal" data-bs-target="#{{$address['address_id']}}">
                                            Delete
                                        </button>
                                    @else
                                        <form action="{{route('front.myaddress.setdefault')}}" method="post" style="width: fit-content;">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="set-default-address-id" value="{{$address->address_id}}" hidden>
                                            <button class="btn-primary set-default-btn fw-semibold">
                                                Set as default
                                            </button>
                                        </form>
                                        <button class="edit-address-btn text-primary" onclick="updateAddress({{$address}})">
                                            Change address
                                        </button>
                                        <button type="button" class="edit-address-btn text-primary" data-bs-toggle="modal" data-bs-target="#{{$address['address_id']}}">
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal Delete Address -->
                        <form action="{{route('front.myaddress.destroy')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal fade" id="{{$address['address_id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="background-color: var(--bg-overlay-2); z-index:9999">
                                    <div class="modal-content" style="background-color: var(--bg-overlay-1); border-radius: 0; z-index:99999;">
                                        <input type="text" name="delete-address-id" value="{{$address['address_id']}}" hidden>
                                        <div class="modal-header border-0">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Address</h1>
                                        </div>
                                        <div class="modal-body text-secondary pt-0">
                                            Are you absolutely sure you want to delete this address? Once deleted, it will be lost forever.
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn text-primary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center submit-address-btn-container">
                        <button type="submit" class="btn btn-primary submit-address-btn fw-semibold" onclick="addNewAddress()">
                            Add Address
                        </button>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Create New User Address -->
        <div class="d-flex justify-content-center create-address-container">
            <form action="{{route('front.myaddress.store')}}" method="post"  id="add-new-address" class="form-add-container" style="display: none;">
                @csrf
                <div class="form-add-container">
                    <div class="add-address-title">
                        <p class="fw-bold">
                            Add New Address
                        </p>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Receiver Name</label>
                        <input name="receiver-name" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Phone Number</label>
                        <input name="phone-number" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Street</label>
                        <input name="street" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">City</label>
                        <input name="city" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">District</label>
                        <input name="district" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Zip Code</label>
                        <input name="zip-code" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Province</label>
                        <input name="province" type="text" class="form-control w-100" required>
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
                    <div class="d-flex justify-content-center submit-add-address-container">
                        <button type="submit" class="btn btn-primary submit-add-address-btn fw-semibold">
                            Add Address
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Update User Address -->
        <div class="d-flex justify-content-center update-address-container">
            <form action="{{route('front.myaddress.update')}}" method="post" id="update-address" class="form-add-container" style="display: none;">
                @csrf
                @method('PUT')
                <input type="text" name="update-address-id" value="" hidden>
                <div class="form-add-container">
                    <div class="add-address-title">
                        <p class="fw-bold">
                            Update Address
                        </p>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Receiver Name</label>
                        <input name="update-receiver-name" value="" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Phone Number</label>
                        <input name="update-phone-number" value="" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Street</label>
                        <input name="update-street" value="" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">City</label>
                        <input name="update-city" value="" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">District</label>
                        <input name="update-district" value="" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Zip Code</label>
                        <input name="update-zip-code" value="" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Province</label>
                        <input name="update-province" value="" type="text" class="form-control w-100" required>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Country</label>
                        <select name="update-country" id="country" class="form-control w-100">
                            @foreach($countries as $country)
                            <option value={{$country}} class="add-address-country">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="add-input-container">
                        <label class="address-label">Description</label>
                        <textarea name="update-description" type="textarea" class="form-control w-100 add-address-description"></textarea>
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
    function addNewAddress() {
        document.getElementById('address').style.display = 'none';
        document.getElementById('add-new-address').style.display = 'block';
    }

    function updateAddress(address) {
        document.getElementById('address').style.display = 'none';
        document.getElementById('update-address').style.display = 'block';

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
    }
</script>

@endsection