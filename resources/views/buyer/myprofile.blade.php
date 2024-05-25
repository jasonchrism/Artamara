@vite('resources/css/tabprofile.css')

@extends('layouts.app')

@section('content')
    <div style="margin-top: 62px;">
        <ul class="nav nav-pills" id="myTab">
            <li class="nav-item tab-link tab-active">
                <a class="" onclick="openTab('profile', this)">Profile</a>
            </li>
            <li class="nav-item tab-link">
                <a class="" onclick="openTab('change-password', this)">Change Password</a>
            </li>
            <li class="nav-item tab-link">
                <a class="" onclick="openTab('address', this)">Address</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div id="profile" class="tab-name text-white" style="display: none;">
                Profile
            </div>
            <div id="change-password" class="tab-name text-white" style="display: none;">
                Change Password
            </div>

            <!-- View User Address List -->
            <div id="address" class="tab-name text-white" style="display: none;">
                <div class="d-flex justify-content-center">
                    <div class="address-list-container">
                        <p class="d-flex justify-content-start view-address-title fw-bold">
                            Address Lists
                        </p>
                        <div class="loop-container">
                            @foreach($user_addresses as $index => $address)
                            
                            <div class="address-box" style="margin-top: {{ !$index == 0 ? '24px' : '' }};">
                                <div>
                                    <div class="d-flex address-name">
                                        <img src="/assets/location-icon.svg" alt="" class="me-2">
                                        <p>{{ $address->receiver }} , {{ $address->phone_number }}</p>
                                    </div>
                                    <p class="address-detail">{{ $address['street'] }}, {{ $address['district'] }}, {{ $address['city'] }}, {{ $address['province'] }}, {{ $address['country'] }}, {{ $address['postal_code'] }}</p>
                                    <div class="edit-btn-container">
                                        <button class="btn-primary set-default-btn fw-semibold">
                                            Set as default
                                        </button>
                                        <button class="edit-address-btn text-primary" onclick="updateAddress({{$address}})">
                                            Change address
                                        </button>
                                        <button class="edit-address-btn text-primary">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary submit-address-btn fw-semibold" onclick="addNewAddress()">
                                Add Address
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create New User Address -->
            <div class="d-flex justify-content-center">
                <form action="/myprofile" method="post" id="add-new-address" class="form-add-container" style="display: none;">
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
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary submit-address-btn fw-semibold">
                                Add Address
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Update User Address -->
            <div class="d-flex justify-content-center">
                <form action="/myprofile" method="post" id="update-address" class="form-add-container" style="display: none;">
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
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary submit-address-btn fw-semibold">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Javascript for tabs -->
    <script>
        function openTab(tabName, element) {
            var tabs = document.getElementsByClassName("tab-name");
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].style.display = "none";
            }

            var tabLinks = document.getElementsByClassName("tab-link");
            for (var i = 0; i < tabLinks.length; i++) {
                tabLinks[i].classList.remove("tab-active");
            }

            document.getElementById(tabName).style.display = "block";
            element.parentNode.classList.add("tab-active");

            if (tabName !== 'address') {
                document.getElementById('add-new-address').style.display = 'none';
                document.getElementById('update-address').style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            openTab('profile', document.querySelector('.tab-link.tab-active a'));
        });
    </script>

    <!-- Javascript for user address -->
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
