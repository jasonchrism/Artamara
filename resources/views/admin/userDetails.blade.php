@extends('layouts.Details')

@section('title')
    {{ $pageTitles }}
@endsection
@push('styles')
@vite('resources/css/userDetails.css')
@endpush
@section('content')
    <div class="container">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('viewAdmin') }}" class="btn" style="color: var(--text-primary);">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="mb-0 .fw-semibold " style="color: var(--text-primary); font-size: 20px;">User Details</h1>
        </div>
        <div class="layout-user-detail">
            <div class="Details-upper-part">
                <div class="user-profile">
                    <img src="{{ Storage::url($user->profile_picture) }}" alt="User Profile Image" style="max-width: 216px;">
                </div>
                <div class="user-details left">
                    <div class="detail-item">
                        <strong style="color: var(--text-primary);">Name</strong>
                        <div style="color: var(--text-secondary);">{{ $user->name }}</div>
                    </div>
                    <div class="detail-item">
                        <strong style="color: var(--text-primary);">Email</strong>
                        <div style="color: var(--text-secondary);">{{ $user->email }}</div>
                    </div>
                    <div class="detail-item">
                        <strong style="color: var(--text-primary);">Phone Number</strong>
                        <div style="color: var(--text-secondary);">{{ $user->phone_number }}</div>
                    </div>
                    <div class="detail-item">
                        <strong style="color: var(--text-primary);">Username</strong>
                        <div style="color: var(--text-secondary);">{{ $user->username }}</div>
                    </div>
                </div>
                <div class="user-details right">
                    <div class="detail-item">
                        <strong style="color: var(--text-primary);">Role</strong>
                        <div style="color: var(--text-secondary);">{{ $user->role }}</div>
                    </div>
                    <div class="detail-item">
                        <strong style="color: var(--text-primary);">About</strong>
                        <div style="color: var(--text-secondary);">{{ $user->about }}</div>
                    </div>
                    <div class="detail-item">
                        <strong style="color: var(--text-primary);">Status</strong>
                        <div
                            class="{{ strtolower($user->status) === 'active' ? 'status-active' : (strtolower($user->status) === 'inactive' ? 'status-inactive' : 'status-unverified') }}">
                            {{ $user->status }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="Details-lower-part">
                @if ($user->role == 'Artist')
                    <div class="Detail-ID">
                        <h2 class=".fw-semibold" style="font-size: 18px; color: var(--text-primary); padding-bottom:24px;">
                            ID Photo</h2>
                        <img src="{{ Storage::url($user->id_photo) }}" alt="User Profile Image" style="max-width: 216px;">
                    </div>
                    <div class="Change-status">
                        @if ($user->status == 'Active')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmationBanned">Ban</button>
                        @elseif ($user->status == 'Unverified')
                            <button type="button" class="btn btn-primary" style="width: 140px;" data-bs-toggle="modal"
                                data-bs-target="#confirmationModal">Accept</button>
                        @endif
                    </div>
                @endif
            </div>
        </div>


        <!-- Modal untuk masuk ke confirmation messages ACCEPT-->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="header">
                        <h1 class="modal-title fs-5" id="confirmationModalLabel">Confirm ID Verification</h1>
                    </div>
                    <div class="content-body">
                        <p style="color: var(--bs-secondary-txt);">Are you sure to accept this artist profile?</p>
                    </div>
                    <div class="footer">
                        <form action="{{ route('acceptArtist', $user->user_id) }}" method="post">
                            @csrf
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="confirmAccept">Accept</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk masuk ke confirmation messages BANNED-->
        <div class="modal fade" id="confirmationBanned" tabindex="-1" aria-labelledby="confirmationBannedLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="header">
                        <h1 class="modal-title fs-5" id="confirmationBannedLabel">Ban Seller</h1>
                    </div>
                    <div class="content-body">
                        <p style="color: var(--bs-secondary-txt);">Are you sure to ban this artist Seller?</p>
                    </div>
                    <div class="footer">
                        <form action="{{ route('banArtist', $user->user_id) }}" method="post">
                            @csrf
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" style="width: 80px" id="confirmBan">Ban</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection


