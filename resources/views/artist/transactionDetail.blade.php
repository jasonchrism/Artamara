@vite('resources/css/artist/transactions/transactionDetail.css')
@extends('layouts.Details')

@section('content')
    <div class="logo-container">
        <a href="" class="logo">
            <svg width="148" height="20" viewBox="0 0 148 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.24008 19.7059H0L8.54684 0H16.5022L25.0786 19.7059H18.6907L17.1824 16.0588H7.77792L6.24008 19.7059ZM11.031 8.32353L9.87766 11.0882L7.6892 16.0294L17.1824 16.0588L13.9884 8.32353L12.6872 5H12.3027L11.031 8.32353Z"
                    fill="#CEFE06" />
                <path
                    d="M31.8252 19.7059H26.2653V4.88235H31.4703V8.76471H31.766C32.18 6.32353 33.7179 4.58824 36.6753 4.58824C39.958 4.58824 41.2592 6.73529 41.2592 9.70588V12.6471H35.6993V10.9118C35.6993 9.67647 35.2261 9.23529 33.777 9.23529C32.2688 9.23529 31.8252 9.67647 31.8252 10.8529V19.7059Z"
                    fill="#CEFE06" />
                <path
                    d="M54.1793 19.7059H50.2755C46.5492 19.7059 44.3312 17.9118 44.3312 14.0588V9.41176H42.1427V4.88235H44.3312V2.32353H49.8911V4.88235H54.1793V9.41176H49.8911V13.2647C49.8911 14.4412 50.246 14.7353 51.5176 14.7353H54.1793V19.7059Z"
                    fill="#CEFE06" />
                <path
                    d="M61.0367 20C58.1681 20 56.2162 18.6471 56.2162 16.2941C56.2162 13.9118 58.1976 12.8824 60.9184 12.5882L67.8683 11.8235V10.7059C67.8683 7.88235 66.6262 6.76471 63.4322 6.76471C60.2974 6.76471 58.6412 7.88235 58.6412 10.4412V10.5588H56.5415V10.4412C56.5415 7.38235 59.0848 4.88235 63.5801 4.88235C68.0162 4.88235 69.9089 7.41176 69.9089 10.6176V19.7059H68.0162V15.7941H67.8683C67.0106 18.4706 64.4377 20 61.0367 20ZM58.3159 16.1471C58.3159 17.6176 59.2919 18.3824 61.5099 18.3824C65.0588 18.3824 67.8683 16.8235 67.8683 13.3235V13.2059L61.569 13.9118C59.3806 14.1176 58.3159 14.6471 58.3159 16.1471Z"
                    fill="#FDFFF3" />
                <path
                    d="M76.0517 19.7059H73.9519V5.17647H75.8447V9.55882H75.963C76.377 7.11765 78.0627 4.88235 81.7003 4.88235C84.9534 4.88235 86.787 6.88235 87.2602 9.70588H87.408C87.8221 7.20588 89.5669 4.88235 93.2341 4.88235C97.0491 4.88235 99.0306 7.55882 99.0306 11.2353V19.7059H96.9308V11.5294C96.9308 8.29412 95.5409 6.79412 92.4652 6.79412C88.9459 6.79412 87.5263 8.82353 87.5263 12.6765V19.7059H85.4266V11.5294C85.4266 8.29412 84.0662 6.79412 80.9905 6.79412C77.4417 6.79412 76.0517 8.82353 76.0517 12.6765V19.7059Z"
                    fill="#FDFFF3" />
                <path
                    d="M107.1 20C104.232 20 102.28 18.6471 102.28 16.2941C102.28 13.9118 104.261 12.8824 106.982 12.5882L113.932 11.8235V10.7059C113.932 7.88235 112.69 6.76471 109.496 6.76471C106.361 6.76471 104.705 7.88235 104.705 10.4412V10.5588H102.605V10.4412C102.605 7.38235 105.148 4.88235 109.644 4.88235C114.08 4.88235 115.972 7.41176 115.972 10.6176V19.7059H114.08V15.7941H113.932C113.074 18.4706 110.501 20 107.1 20ZM104.38 16.1471C104.38 17.6176 105.355 18.3824 107.573 18.3824C111.122 18.3824 113.932 16.8235 113.932 13.3235V13.2059L107.633 13.9118C105.444 14.1176 104.38 14.6471 104.38 16.1471Z"
                    fill="#FDFFF3" />
                <path
                    d="M122.115 19.7059H120.016V5.17647H121.908V9.14706H122.056C122.5 6.82353 124.156 4.88235 127.202 4.88235C130.573 4.88235 132.052 7.35294 132.052 10.0588V11.5H129.952V10.3824C129.952 7.91176 128.917 6.70588 126.374 6.70588C123.417 6.70588 122.115 8.55882 122.115 11.8235V19.7059Z"
                    fill="#FDFFF3" />
                <path
                    d="M139.128 20C136.259 20 134.307 18.6471 134.307 16.2941C134.307 13.9118 136.289 12.8824 139.01 12.5882L145.959 11.8235V10.7059C145.959 7.88235 144.717 6.76471 141.523 6.76471C138.389 6.76471 136.732 7.88235 136.732 10.4412V10.5588H134.633V10.4412C134.633 7.38235 137.176 4.88235 141.671 4.88235C146.107 4.88235 148 7.41176 148 10.6176V19.7059H146.107V15.7941H145.959C145.102 18.4706 142.529 20 139.128 20ZM136.407 16.1471C136.407 17.6176 137.383 18.3824 139.601 18.3824C143.15 18.3824 145.959 16.8235 145.959 13.3235V13.2059L139.66 13.9118C137.472 14.1176 136.407 14.6471 136.407 16.1471Z"
                    fill="#FDFFF3" />
            </svg>
        </a>
    </div>


    <div class="transaction-detail-container d-flex justify-content-center">
        @foreach ($groupedProducts as $orderId => $orderData)
            <!-- Order Details -->
            <div class="order-details-container">
                <div class="order-details-header d-flex align-items-center">
                    <a href="{{ route('artist-transactions.index') }}" class="btn" style="color: var(--text-primary);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="margin-right: 16px;">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.26904 11.9984L8.23384 5.03204L9.36664 6.16324L4.33144 11.1984L22.4002 11.1984L22.4002 12.7984L4.33144 12.7984L9.36664 17.832L8.23384 18.9648L1.26904 11.9984Z"
                                fill="#FDFFF3" />
                        </svg>
                    </a>
                    <p class="fw-semibold text-white m-0 order-details-p">Order Details</p>
                </div>

                <div class="order-container">
                    <p class="text-white fw-semibold" style="margin-bottom: 8px;">Order Id</p>
                    <p class="text-white">{{ $orderId }}</p>
                </div>

                <div class="order-container">
                    <p class="text-white fw-semibold" style="margin-bottom: 8px;">Date</p>
                    <p class="text-white">{{ $orderData['payment_max'] }}</p>
                </div>

                <div class="order-container">
                    <p class="text-white fw-semibold" style="margin-bottom: 8px;">Buyer Name</p>
                    <p class="text-white">{{ $orderData['buyer'] }}</p>
                </div>

                <div class="order-container">
                    <p class="text-white fw-semibold" style="margin-bottom: 8px;">Name Receiver</p>
                    <p class="text-white">{{ $orderData['buyer_address']->receiver }}</p>
                </div>

                <div class="order-container">
                    <p class="text-white fw-semibold" style="margin-bottom: 8px;">Phone number receiver</p>
                    <p class="text-white">{{ $orderData['buyer_address']->phone_number }}</p>
                </div>

                <div class="order-container">
                    <p class="text-white fw-semibold" style="margin-bottom: 8px;">Shipment Address</p>
                    <p class="text-white">
                        {{ $orderData['buyer_address']->street }},
                        {{ $orderData['buyer_address']->district }},
                        {{ $orderData['buyer_address']->city }},
                        {{ $orderData['buyer_address']->province }},
                        {{ $orderData['buyer_address']->country }},
                        {{ $orderData['buyer_address']->postal_code }},
                    </p>
                </div>

                <div class="order-container">
                    <p class="text-white fw-semibold" style="margin-bottom: 8px;">Payment Method</p>
                    <p class="text-white">{{ $orderData['payment_method'] }}</p>
                </div>

                <div class="order-container">
                    <p class="text-white fw-semibold" style="margin-bottom: 8px;">Total Price</p>
                    <p class="text-white">{{'Rp' . number_format($orderData['grand_total'], 0, ',', '.');}}</p>
                </div>
                @if ($orderData['orderstatus'] !== 'PACKING')
                    <div class="order-container">
                        <p class="text-white fw-semibold" style="margin-bottom: 8px;">Shipment Number</p>
                        <p class="text-white">{{ $orderData['shipment_number'] }}</p>
                    </div>
                @endif
            </div>

            <!-- Item Details -->
            <div class="item-details-container">
                <p class="text-white fw-semibold item-details-header">Item Details</p>
                <div class="item-container">
                    @foreach ($orderData['artists'] as $artistId => $products)
                        {{-- {{ dd($products) }} --}}
                        <p class="text-white fw-medium buyer-name">{{ $products['name'] }}</p>
                        @foreach ($products['products'] as $product)
                            {{-- {{ dd($products['products']) }} --}}
                            <div class="details-container d-flex">
                                <img src="{{ $product['product']->thumbnail }}" alt="" class="item-picture">
                                <div class="d-flex justify-content-between" style="width: 100%;">
                                    <div class="item-detail">
                                        <p class="text-white fw-medium" style="margin-bottom: 2px;">
                                            {{ $product['product']->product_id }}
                                        </p>
                                        <p class="text-secondary">{{ $product['product']->title }}</p>
                                    </div>
                                    <div class="item-quantity d-flex">
                                        <p class="text-white quantity-p">{{ $product['quantity'] }}x</p>
                                        <p class="text-white">{{ 'Rp' . number_format($product['product']->price, 0, ',', '.'); }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    <div class="sent-btn-container d-flex justify-content-end">
                        {{-- <button type="button" class="btn btn-primary sent-btn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Sent</button> --}}
                        {{-- {{dd($orderData)}} --}}
                        @if ($orderData['orderstatus'] === 'PACKING')
                            <button type="button" class="btn btn-primary sent-btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Sent</button>
                        @elseif($orderData['orderstatus'] === 'RETURNED')
                            <button type="button" class="btn btn-secondary appeal-btn" data-bs-toggle="modal"
                                data-bs-target="#appealModal">Appeal</button>
                        @endif
                    </div>
                    <!-- Confirm Shipment Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content"
                                style="background-color: var(--bg-overlay-1); border-radius: 0; border: 1px solid #464646;"
                                action="{{ route('artist-transactions.update', $orderId) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header p-0" style="border: none; margin-bottom: 16px;">
                                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel"
                                        style="margin-top: 24px; margin-left: 24px;">Confirm Shipment</h1>
                                </div>
                                <div class="modal-body p-0" style="border: none; margin-left: 24px; margin-right: 24px;">
                                    <p class="text-secondary">Submit Your Tracking Number</p>
                                    <div class="receipt-container">
                                        <p class="text-white" style="margin-bottom: 6px;">Receipt Number</p>
                                        <input name="receipt_number" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer p-0"
                                    style="border: none; margin-top: 24px; margin-right: 24px; margin-bottom: 24px;">
                                    <button type="button" class="btn text-primary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
    @push('after-scripts')
        <script>
            // Modal Js
            const myModal = document.getElementById('myModal')
            const myInput = document.getElementById('myInput')

            myModal.addEventListener('shown.bs.modal', () => {
                myInput.focus()
            })
        </script>
    @endpush
