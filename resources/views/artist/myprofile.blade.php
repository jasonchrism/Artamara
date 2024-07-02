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
            <a class="" href="/dashboard/artist/myprofile">Profile</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="/dashboard/artist/myprofile/changepassword">Change Password</a>
        </li>
    </ul>
    
    <div id="profile" class="tab-name text-white">
        <div class="d-flex justify-content-center">
            <div class="profile-container">
                <p class="fw-bold profile-title">
                    Profile
                </p>
                <p class="profile-subtitle">Manage your profile with ease and enjoy a safer, more secure experience.</p>

                <div class="profile-content">
                    <form action="{{ route('editProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="profile-image col-4 d-flex align-items-center flex-column">
                                @if (Auth::user()->profile_picture == '-')
                                    <img src="https://via.placeholder.com/800x600" alt="" id="photopreview1">
                                @else
                                    <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="" id="photopreview1">
                                @endif
                                <input type="file" name="profile_picture" id="profile_picture" onchange="previewImage(event)"
                                    class="inputfile @error('profile_picture') is-invalid @enderror" />
                                <label for="profile_picture">Choose Avatar</label>

                                @error('profile_picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="profile-form col-8">
                                <label for="name" class="text-white fw-semibold mb-2">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value='{{ $artist['name'] }}''>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="email"
                                    class="text-white fw-semibold mb-2 mt-3">{{ __('Email') }}</label>
                                <p class="profile-subtitle">{{ $artist['email'] }}</p>

                                <label for="username"
                                    class="text-white fw-semibold mb-2 mt-3">{{ __('Username') }}</label>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $artist['username'] }}">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="phone_number" class="text-white fw-semibold mb-2 mt-3">{{ __('Phone number') }}</label>
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $address['phone_number'] }}">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="cardphoto" class="text-white fw-semibold mb-2 mt-3">{{ __('Card Photo') }}</label>
                                <div class="idcard-Img">
                                    @if (Auth::user()->id_photo == '-')
                                    <img src="https://via.placeholder.com/800x600" alt="">
                                    @else
                                    <img src="{{ Storage::url(Auth::user()->id_photo) }}" alt="">
                                    @endif
                                </div>

                                <div class="inputerror d-flex flex-column">
                                    <label for="street" class="text-white fw-semibold mb-2 mt-3">{{ __('Street') }}</label>
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $address['street'] }}">
                                    <div class="errormessage">
                                        @error('street')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-row d-flex">
                                    <div class="form-group" style="width: 265px">
                                        <label for="province" class="text-white fw-semibold mb-2 mt-3">{{ __('Province') }}</label>
                                        <input id="province" type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ $address['province'] }}">
                                        <div class="errormessage">
                                            @error('province')
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group right-form" style="width: 265px">
                                        <label for="city" class="text-white fw-semibold mb-2 mt-3">{{ __('City') }}</label>
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $address['city'] }}">
                                        <div class="errormessage">
                                            @error('city')
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row d-flex">
                                    <div class="form-group" style="width: 265px">
                                        <label for="district" class="text-white fw-semibold mb-2 mt-3">{{ __('District') }}</label>
                                        <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ $address['district'] }}">
                                        <div class="errormessage">
                                            @error('district')
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group right-form" style="width: 265px">
                                        <label for="postal_code" class="text-white fw-semibold mb-2 mt-3">{{ __('Postal Code') }}</label>
                                        <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ $address['postal_code'] }}">
                                        <div class="errormessage">
                                            @error('postal_code')
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <label for="description" class="text-white fw-semibold mb-2 mt-3">{{ __('Description') }}</label>
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $address['description'] }}">
                                <div class="errormessage">
                                    @error('description')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="rightbutton d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mt-3">
                                        Save
                                    </button>
                                </div>

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        
    
@endsection

<script>
    const previewImage = (event) =>{
        const files = event.target.files;
        if(files.length > 0) {
            const imageURL = URL.createObjectURL(files[0]);
            const imageElement = document.getElementById("photopreview1");
            imageElement.src = imageURL;
        }
    }


</script>