@vite('resources/css/tabprofile.css')
@extends('layouts.app')

@section('content')
@include('includes.notification')
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
                                    <!-- <form method="post"> -->
                                        <!-- @csrf -->
                                        <!-- <input type="text" name="update-view" value={{$address->address_id}} hidden> -->
                                        <a href="/{{$address->address_id}}/update">
                                            <button type="submit" class="edit-address-btn text-primary">
                                                Change address
                                            </button>
                                        </a>
                                    <!-- </form> -->
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
                                        <!-- <form method="post"> -->
                                            <!-- @csrf -->
                                            <!-- <input type="text" name="update-view" value={{$address->address_id}} hidden> -->
                                            <a href="/{{$address->address_id}}/update">
                                                <button type="submit" class="edit-address-btn text-primary">
                                                    Change address
                                                </button>
                                            </a>
                                        <!-- </form> -->
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
                    <form action="{{route('front.myaddress.addaddress')}}" method="get">
                        <div class="d-flex justify-content-center submit-address-btn-container">
                            <button type="submit" class="btn btn-primary submit-address-btn fw-semibold">
                                Add Address
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection