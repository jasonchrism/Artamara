@vite('resources/css/artist/myprofile.css')
@extends('layouts.dashboard')
@section('title')
    My Profile
@endsection

@section('header_title')
    Welcome, {{ $artist->name }}
@endsection

@section('content')
    <ul class="nav nav-pills" id="myTab">
        <li class="nav-item tab-link tab-active">
            <a class="" href="#">Profile</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="#">Change Password</a>
        </li>
    </ul>
        
    <div class="profile-container d-flex justify-content-center">
        <div class="form-container">
            <div class="top">
                <p class="title fw-semibold">Profile</p>
                <p class="title-description">Manage your profile with ease and enjoy a safer, more secure experience.</p>
            </div>
            <form action="{{ route('editProfile') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bottom d-flex">
                <div class="left">
                    <div class="d-flex flex-column justify-content-center profile-picture-container">
                        @if (Auth::user()->profile_picture == '-')
                        <div class="profile-pic-container">
                            <img src="https://via.placeholder.com/400x600" alt="">
                        </div>
                        @else
                        <div class="profile-pic-container">
                            <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="">
                        </div>
                        @endif
                        <div class="d-flex justify-content-center add-pic-container">
                            <input type="file" name="profile_picture" id="profile_picture" class="inputfile @error('profile_picture') is-invalid @enderror" style="display: none;"/>
                            <label for="profile_picture" class="profile-pic-label">Choose Avatar</label>
                            @error('profile_picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="right">
                        <div class="form-group">
                            <label for="name" class="fw-semibold">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $artist->name }}">
                        </div>
                        <div class="form-group form-email">
                            <label for="email" class="fw-semibold">Email</label>
                            <label for="emailValue" class="artist-email">{{ $artist->email }}</label>
                        </div>
                        <div class="form-group">
                            <label for="name" class="fw-semibold">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ $artist->username }}">
                        </div>
                        <div class="form-group">
                            <label for="name" class="fw-semibold">Phone number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $artist->phone_number }}">
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="card-photo" class="fw-semibold">Card Photo</label>
                            <img src="https://via.placeholder.com/800x600" alt="">
                        </div>
                        <div class="form-group">
                            <label for="street" class="fw-semibold">Street</label>
                            <input type="text" name="street" id="street" class="form-control" value="{{ $address->street }}">
                        </div>
                        <div class="form-group d-flex flex-row">
                            <div class="form-group-detail">
                                <label for="street" class="fw-semibold">Province</label>
                                <input type="text" name="province" id="province" class="form-control" value="{{ $address->province }}">
                            </div>
                            <div class="form-group-detail ml-11">
                                <label for="street" class="fw-semibold">City</label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ $address->city }}">
                            </div>
                        </div>
                        <div class="form-group d-flex flex-row">
                            <div class="form-group-detail">
                                <label for="street" class="fw-semibold">District</label>
                                <input type="text" name="district" id="district" class="form-control" value="{{ $address->district }}">
                            </div>
                            <div class="form-group-detail ml-11">
                                <label for="street" class="fw-semibold">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ $address->postal_code }}">
                                @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="street" class="fw-semibold">Description</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ $address->description }}">
                        </div>
                        <div class="d-flex justify-content-end mb-4">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection