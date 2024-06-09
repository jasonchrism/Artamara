@vite('resources/css/buyer/mytransactions.css')
@extends('layouts.app')

@section('content')
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

@endsection