@vite('resources/css/buyer/tabprofile.css')
@include('includes.addressNotification')
@extends('layouts.app')

@section('content')
    <div style="margin-top: 62px;">
        <ul class="nav nav-pills" id="myTab">
            <li class="nav-item tab-link tab-active">
                <a class="" href="/myprofile">Profile</a>
            </li>
            <li class="nav-item tab-link">
                <a class="" href="/myprofile/password">Change Password</a>
            </li>
            <li class="nav-item tab-link">
                <a class="" href="/myaddress">Address</a>
            </li>
        </ul>

        <!-- View User Edit Profile -->
        <div id="profile" class="tab-name text-white">
            <div class="d-flex justify-content-center">
                <div class="profile-container">
                    <p class="fw-bold profile-title">
                        Profile
                    </p>
                    <p class="profile-subtitle">Manage your profile with ease and enjoy a safer, more secure experience.</p>

                    <div class="profile-content">
                        <form action="{{ route('front.editprofile.update') }}" method="post" enctype="multipart/form-data">
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
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value='{{ $user_profile['name'] }}''>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <label for="email"
                                        class="text-white fw-semibold mb-2 mt-3">{{ __('Email') }}</label>
                                    <p class="profile-subtitle">{{ $user_profile['email'] }}</p>

                                    <label for="username"
                                        class="text-white fw-semibold mb-2 mt-3">{{ __('Username') }}</label>
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ $user_profile['username'] }}">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <label for="phone_number"
                                        class="text-white fw-semibold mb-2 mt-3">{{ __('Phone number') }}</label>
                                    <input id="phone_number" type="text"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ $user_profile['phone_number'] }}">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

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
    </div>
    </div>

    </div>
@endsection

<!-- Javascript for picture preview -->

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