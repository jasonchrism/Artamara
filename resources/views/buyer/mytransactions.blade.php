@vite('resources/css/buyer/mytransactions.css')
@extends('layouts.app')

@section('content')
<div style="margin-top: 62px;">
    <ul class="nav nav-pills" id="myTab">
        <li class="nav-item tab-link tab-active">
            <a class="" href="#">Payment</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="#">Packing</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="#">Shipping</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="#">Finished</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="#">Returned</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="#">Cancelled</a>
        </li>
    </ul>
</div>

{{-- mulai dari ini adalah konten di bawah tab, untuk payment akan ditaruh di sini sebagai default. --}}

{{-- dari sini harusnya di for each --}}
<div class="transaction-container">

    <div class="transaction-user-date">

        {{-- ini untuk sisi kiri (profile dan nama) --}}
        <div class="transaction-user-date-left">

            <div class="User-About-Details">
                <div class="User-Details-Pic">
                    @if (Auth::user()->profile_picture == '-')
                        <img src="https://via.placeholder.com/800x600" alt="" id="photopreview1">
                    @else
                        <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="" id="photopreview1">
                    @endif
                </div>

                <div class="User-name">
                    <p style="font-weight: 300;">{{ Auth::user()->name }}</p>
                </div>
            </div>

        </div>

        {{-- ini untuk tanggal --}}
        <div class="transaction-user-date-right">
            <p>
                
            </p>
        </div>

    </div>
    <div class="transaction-painting-lists">
        ini details
    </div>
    <div class="transaction-buttons">
        ini button
    </div>
</div>

@endsection
