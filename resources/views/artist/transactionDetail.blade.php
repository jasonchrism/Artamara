@vite('resources/css/artist/transactions/transactionDetail.css')
@extends('layouts.Details')

@section('content')

<div class="transaction-detail-container d-flex justify-content-center">
    <div class="order-details-container">
        <div class="order-details-header d-flex align-items-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 16px;">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.26904 11.9984L8.23384 5.03204L9.36664 6.16324L4.33144 11.1984L22.4002 11.1984L22.4002 12.7984L4.33144 12.7984L9.36664 17.832L8.23384 18.9648L1.26904 11.9984Z" fill="#FDFFF3" />
            </svg>
            <p class="fw-semibold text-white m-0" style="font-size: 20px;">Order Details</p>
        </div>

        <div class="order-container">
            <p class="text-white fw-semibold" style="margin-bottom: 8px;">Order Id</p>
            <p class="text-white">0812981288</p>
        </div>

        <div class="order-container">
            <p class="text-white fw-semibold" style="margin-bottom: 8px;">Date</p>
            <p class="text-white">24-12-2024</p>
        </div>

        <div class="order-container">
            <p class="text-white fw-semibold" style="margin-bottom: 8px;">Buyer Name</p>
            <p class="text-white">Jason Chrisbellno</p>
        </div>

        <div class="order-container">
            <p class="text-white fw-semibold" style="margin-bottom: 8px;">Name Receiver</p>
            <p class="text-white">Joel</p>
        </div>

        <div class="order-container">
            <p class="text-white fw-semibold" style="margin-bottom: 8px;">Phone number receiver</p>
            <p class="text-white">081298127722</p>
        </div>

        <div class="order-container">
            <p class="text-white fw-semibold" style="margin-bottom: 8px;">Shipment Address</p>
            <p class="text-white">Jl. Pakuan No.3, Sumur Batu, Kec.
                Babakan Madang, Kabupaten Bogor,
                Jawa Barat 16810
            </p>
        </div>

        <div class="order-container">
            <p class="text-white fw-semibold" style="margin-bottom: 8px;">Payment Method</p>
            <p class="text-white">Gopay</p>
        </div>

        <div class="order-container">
            <p class="text-white fw-semibold" style="margin-bottom: 8px;">Total Price</p>
            <p class="text-white">Rp200.000.000</p>
        </div>
    </div>

    <div class="item-details-container">
        <p class="text-white fw-semibold item-details-header">Item Details</p>
        <div class="item-container">
            <p class="text-white fw-medium" style="margin-left: 32px; margin-bottom: 24px;">Joko Pinurbo</p>
            <div class="details-container d-flex">
                <img src="https://placehold.co/400" alt="" class="item-picture">
                <div class="d-flex justify-content-between" style="width: 100%;">
                    <div class="item-detail">
                        <p class="text-white fw-medium" style="margin-bottom: 2px;">918291282</p>
                        <p class="text-secondary">Sepi dipenghujung tahun</p>
                    </div>
                    <div class="item-quantity d-flex">
                        <p class="text-white" style="margin-right: 40px;">1x</p>
                        <p class="text-white">Rp120.000.000</p>
                    </div>
                </div>
            </div>

            <p class="text-white fw-medium" style="margin-left: 32px; margin-bottom: 24px;">Joko Pinurbo</p>
            <div class="details-container d-flex">
                <img src="https://placehold.co/400" alt="" class="item-picture">
                <div class="d-flex justify-content-between" style="width: 100%;">
                    <div class="item-detail">
                        <p class="text-white fw-medium" style="margin-bottom: 2px;">918291282</p>
                        <p class="text-secondary">Sepi dipenghujung tahun</p>
                    </div>
                    <div class="item-quantity d-flex">
                        <p class="text-white" style="margin-right: 40px;">1x</p>
                        <p class="text-white">Rp120.000.000</p>
                    </div>
                </div>
            </div>

            <p class="text-white fw-medium" style="margin-left: 32px; margin-bottom: 24px;">Joko Pinurbo</p>
            <div class="details-container d-flex">
                <img src="https://placehold.co/400" alt="" class="item-picture">
                <div class="d-flex justify-content-between" style="width: 100%;">
                    <div class="item-detail">
                        <p class="text-white fw-medium" style="margin-bottom: 2px;">918291282</p>
                        <p class="text-secondary">Sepi dipenghujung tahun</p>
                    </div>
                    <div class="item-quantity d-flex">
                        <p class="text-white" style="margin-right: 40px;">1x</p>
                        <p class="text-white">Rp120.000.000</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="sent-btn-container d-flex justify-content-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Sent</button>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-color: var(--bg-overlay-1);">
                    <div class="modal-header p-0" style="border: none; margin-bottom: 16px;">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel" style="margin-top: 24px; margin-left: 24px;">Confirm Shipment</h1>
                    </div>
                    <div class="modal-body p-0" style="border: none; margin-left: 24px; margin-right: 24px;">
                        <p class="text-secondary">Submit Your Tracking Number</p>
                        <div class="receipt-container">
                            <p class="text-white" style="margin-bottom: 6px;">Receipt Number</p>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer p-0" style="border: none; margin-top: 24px; margin-right: 24px; margin-bottom: 24px;">
                        <button type="button" class="btn text-primary" data-bs-dismiss="modal" >Cancel</button>
                        <button type="button" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
</script>

@endsection