@vite('resources/css/tabprofile.css')

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

                        <div class="profile-content row">
                            <div class="profile-image col-lg-4 d-flex align-items-center flex-column">
                                <img src="{{$user_profile['profile_picture']}}" alt="">
                                <input type="file" name="image" id="image" class="inputfile" />
                                <label for="image">Choose Avatar</label>
                            </div>
                            <div class="profile-form col-lg-8 ">
                                <form action="{{route('front.editprofile.update')}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <label for="name" class="text-white fw-semibold mb-2">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control mb-3" name="name" value='{{$user_profile['name']}}''>
                                    
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <label for="email" class="text-white fw-semibold mb-2">{{ __('Email') }}</label>
                                    <p class="profile-subtitle mb-3">{{$user_profile['email']}}</p>

                                    <label for="username" class="text-white fw-semibold mb-2">{{ __('Username') }}</label>
                                    <input id="username" type="text" class="form-control mb-3" name="username" value="{{$user_profile['username']}}">

                                    <label for="phone_number" class="text-white fw-semibold mb-2">{{ __('Phone number') }}</label>
                                    <input id="phone_number" type="text" class="form-control mb-3" name="phone_number" value="{{$user_profile['phone_number']}}">

                                    <div class="rightbutton d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mb-3">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>

</div>

<!-- Javascript for eye toggle -->
<script>

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector('#oldPassword')


togglePassword.addEventListener('click', function(e) {
    const type = password.getAttribute('type') === 'password'? 'text' : 'password';
    password.setAttribute('type', type);

    if (togglePassword.classList.contains('fa-eye')) {
        togglePassword.classList.remove('fa-eye');
        togglePassword.classList.add('fa-eye-slash');
    } else if (togglePassword.classList.contains('fa-eye-slash')) {
        togglePassword.classList.remove('fa-eye-slash');
        togglePassword.classList.add('fa-eye');
    }

});

const togglePassword2 = document.querySelector("#togglePassword2");
const password2 = document.querySelector('#newPassword')


togglePassword2.addEventListener('click', function(e) {
    const type = password2.getAttribute('type') === 'password'? 'text' : 'password';
    password2.setAttribute('type', type);

    if (togglePassword2.classList.contains('fa-eye')) {
        togglePassword2.classList.remove('fa-eye');
        togglePassword2.classList.add('fa-eye-slash');
    } else if (togglePassword2.classList.contains('fa-eye-slash')) {
        togglePassword2.classList.remove('fa-eye-slash');
        togglePassword2.classList.add('fa-eye');
    }

});

</script>
@endsection