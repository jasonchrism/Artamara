@extends('layouts.app')
@push('styles')
    @vite('resources/css/buyer/order/orderDetail.css')
@endpush

@include('includes.addressNotification')

@section('content')
    <div class="order-container mt-5">
        <h4 class="text-white mb-4">Order & Shipment</h4>
        <div class="d-flex">
            <div class="wrap-left">
                <div class="address-container bg-overlay-1 p-4 w-100 mb-3">
                    <h6 class="text-white fw-medium mb-3">Shipping Address</h6>
                    <div class="d-flex">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 13.5C11.2583 13.5 10.5333 13.2801 9.91661 12.868C9.29993 12.456 8.81928 11.8703 8.53545 11.1851C8.25162 10.4998 8.17736 9.74584 8.32206 9.01841C8.46675 8.29098 8.8239 7.6228 9.34835 7.09835C9.8728 6.5739 10.541 6.21675 11.2684 6.07206C11.9958 5.92736 12.7498 6.00162 13.4351 6.28545C14.1203 6.56928 14.706 7.04993 15.118 7.66661C15.5301 8.2833 15.75 9.00832 15.75 9.75C15.7488 10.7442 15.3533 11.6973 14.6503 12.4003C13.9473 13.1033 12.9942 13.4988 12 13.5ZM12 7.5C11.555 7.5 11.12 7.63196 10.75 7.8792C10.38 8.12643 10.0916 8.47783 9.92127 8.88896C9.75098 9.3001 9.70642 9.7525 9.79323 10.189C9.88005 10.6254 10.0943 11.0263 10.409 11.341C10.7237 11.6557 11.1246 11.87 11.561 11.9568C11.9975 12.0436 12.4499 11.999 12.861 11.8287C13.2722 11.6584 13.6236 11.37 13.8708 11C14.118 10.63 14.25 10.195 14.25 9.75C14.2494 9.15345 14.0122 8.5815 13.5903 8.15967C13.1685 7.73784 12.5966 7.5006 12 7.5Z"
                                fill="#CEFE06" />
                            <path
                                d="M12 22.5L5.67301 15.0382C5.58509 14.9262 5.49809 14.8135 5.41201 14.7C4.33179 13.276 3.74799 11.5373 3.75001 9.75C3.75001 7.56196 4.6192 5.46354 6.16637 3.91637C7.71355 2.36919 9.81197 1.5 12 1.5C14.188 1.5 16.2865 2.36919 17.8336 3.91637C19.3808 5.46354 20.25 7.56196 20.25 9.75C20.2517 11.5365 19.6682 13.2743 18.5888 14.6978L18.588 14.7C18.588 14.7 18.363 14.9955 18.3293 15.0353L12 22.5ZM6.60975 13.7963C6.60975 13.7963 6.7845 14.0272 6.82425 14.0767L12 20.181L17.1825 14.0685C17.2155 14.0272 17.391 13.7948 17.3918 13.794C18.2747 12.6309 18.7518 11.2103 18.75 9.75C18.75 7.95979 18.0388 6.2429 16.773 4.97703C15.5071 3.71116 13.7902 3 12 3C10.2098 3 8.4929 3.71116 7.22703 4.97703C5.96116 6.2429 5.25001 7.95979 5.25001 9.75C5.24815 11.2112 5.72584 12.6327 6.60975 13.7963Z"
                                fill="#CEFE06" />
                        </svg>
                        <div class="address-content ps-2">
                            @if ($addressDefault)
                                <p class="head-address">{{ $addressDefault->address->receiver }},
                                    {{ $addressDefault->address->phone_number }}</p>
                                <p class="detail-address text-white">{{ $addressDefault->address->description }},
                                    {{ $addressDefault->address->street }}, {{ $addressDefault->address->district }},
                                    {{ $addressDefault->address->city }}, {{ $addressDefault->address->province }},
                                    {{ $addressDefault->address->postal_code }}</p>
                                <button class="btn btn-address text-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#address">Change Address</button>
                            @else
                                <p class="head-address">No Address</p>
                                <button class="btn btn-address text-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#address">Change Address</button>
                            @endif

                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="address" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-overlay-1">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100 text-white" id="exampleModalLabel">Address List</h5>
                                    <button type="button" data-bs-dismiss="modal" class="close" aria-label="Close"><svg
                                            width="32" height="32" viewBox="0 0 32 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.53366 25.3327L6.66699 23.466L14.1337 15.9993L6.66699 8.53268L8.53366 6.66602L16.0003 14.1327L23.467 6.66602L25.3337 8.53268L17.867 15.9993L25.3337 23.466L23.467 25.3327L16.0003 17.866L8.53366 25.3327Z"
                                                fill="#464646" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="loop-container">
                                        @if ($isAddressNull == null)
                                            <p class="text-white text-center">No address available</p>
                                        @endif
                                        @foreach ($userAddress as $index => $address)
                                            <div class="address-box" style="margin-top: {{ !$index == 0 ? '24px' : '' }};">
                                                <div
                                                    class="d-flex flex-column h-100  {{ $address->is_default == 1 ? 'default-address' : '' }} ">
                                                    <div>
                                                        <input type="text" name="delete-address-id" value=""
                                                            hidden>
                                                        <div class="d-flex address-name">
                                                            <img src="/assets/location-icon.svg" alt=""
                                                                class="me-2 location-icon">
                                                            <p>{{ $address->address->receiver }} ,
                                                                {{ $address->address->phone_number }}</p>
                                                        </div>
                                                        <p class="address-detail">{{ $address->address->street }},
                                                            {{ $address->address->district }},
                                                            {{ $address->address->city }},
                                                            {{ $address->address->province }},
                                                            {{ $address->address->country }},
                                                            {{ $address->address->postal_code }}</p>
                                                    </div>
                                                    <div class="edit-btn-container mt-auto">
                                                        @if ($address->is_default)
                                                            <a
                                                                href="{{ route('front.order.address.update', $address->address_id) }}">
                                                                <button type="submit"
                                                                    class="edit-address-btn text-primary">
                                                                    Change address
                                                                </button>
                                                            </a>
                                                            <!-- </form> -->
                                                            <button type="button" class="edit-address-btn text-primary"
                                                                data-bs-toggle="modal" data-bs-dismiss="modal"
                                                                data-bs-target="#{{ $address['address_id'] }}">
                                                                Delete
                                                            </button>
                                                        @else
                                                            <form action="{{ route('front.order.address.choose') }}"
                                                                method="post" style="width: fit-content;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="text" name="set-default-address-id"
                                                                    value="{{ $address->address_id }}" hidden>
                                                                <button class="btn-primary set-default-btn fw-semibold">
                                                                    Choose
                                                                </button>
                                                            </form>

                                                            <a
                                                                href="{{ route('front.order.address.update', $address->address_id) }}">
                                                                <button type="submit"
                                                                    class="edit-address-btn text-primary">
                                                                    Change address
                                                                </button>
                                                            </a>
                                                            <!-- </form> -->
                                                            <button type="button" class="edit-address-btn text-primary"
                                                                data-bs-toggle="modal" data-bs-dismiss="modal"
                                                                data-bs-target="#{{ $address['address_id'] }}">
                                                                Delete
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('front.order.address.create') }}"
                                        class="btn btn-primary btn-add w-100">Add Address</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-container bg-overlay-1 p-4 w-100">
                    @foreach ($groupedOrder as $artistName => $items)
                        <h6 class="text-white fw-medium mb-3">{{ $artistName }}</h6>
                        @foreach ($items as $item)
                            <div class="d-flex ps-3 pb-3 pe-1 justify-content-between">
                                <img src="{{ $item['product']->thumbnail }}" alt="" class="object-fit-cover"
                                    style="width: 80px; height:80px">
                                <div class="product-content w-50">
                                    <h6 class="text-white">{{ $item['product']->title }}</h6>
                                    <p class="text-secondary-txt">{{ $item['product']->year }}</p>
                                </div>
                                <p>{{ $item['quantity'] }}x</p>
                                <p>{{ 'Rp' . number_format($item['product']->price, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="wrap-right">
                <div class="summary-container bg-overlay-1 p-4 w-100 ms-4">
                    <h5 class="text-white fw-medium mb-3">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <p class="text-secondary-txt">Total Price ({{ $order->count() }} items)</p>
                        <p class="text-white">{{ 'Rp' . number_format($total, 0, ',', '.') }}</p>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <p class="text-secondary-txt">Shipment ({{ $shipment['region'] }})</p>
                        <p class="text-white">{{ 'Rp' . number_format($shipment['cost'], 0, ',', '.') }}</p>
                    </div>
                    <p class="text-secondary-txt desc-ship">*Based on the inputted address, the shipping
                        cost is divided into 2 rates: domestic
                        and international.</p>

                    <div class="d-flex justify-content-between">
                        <h6 class="text-white">Grand Total</h6>
                        <p class="text-white">{{ 'Rp' . number_format($shipment['cost'] + $total, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="ms-4 mt-3 w-100">
                    <form action="{{ route('front.order.store') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $order }}" name="order">
                        <input type="hidden" value="{{ $total }}" name="totalPrice">
                        <input type="hidden" value="{{ $shipment['cost'] }}" name="shipmentCost">
                        <input type="hidden" value="{{ $addressDefault ? $addressDefault->address_id : null }}"
                            name="addressId">
                        <button class="btn btn-primary w-100 mb-3" id="pay-button">Pay Now</button>
                    </form>
                    <p class="text-secondary-txt w-100 text-center desc-payment">All payment is covered by third party
                        partner You will
                        redirect to payment section</p>
                </div>
            </div>
        </div>

        @foreach ($userAddress as $index => $address)
            <!-- Modal Delete Address -->
            <form action="{{ route('front.order.address.delete') }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="{{ $address['address_id'] }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="background-color: var(--bg-overlay-2); z-index:9999">
                        <div class="modal-content"
                            style="background-color: var(--bg-overlay-1); border-radius: 0; z-index:99999;">
                            <input type="text" name="delete-address-id" value="{{ $address['address_id'] }}" hidden>
                            <div class="modal-header border-0">
                                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Delete
                                    Address</h1>
                            </div>
                            <div class="modal-body text-secondary pt-0">
                                Are you absolutely sure you want to delete this address?
                                Once deleted, it will be lost forever.
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
    @endsection
