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
        <div id="profile" class="tab-name text-white" style="display: none;">
            <div class="d-flex justify-content-center">
                <div class="profile-container">
                    <p class="fw-bold profile-title">
                        Profile
                    </p>
                    <p class="profile-subtitle">Manage your profile with ease and enjoy a safer, more secure experience.</p>

                    <div class="profile-content row">
                        <div class="profile-image col-lg-4 d-flex align-items-center flex-column">
                            <img src="assets/profile2.jpg" alt="">
                            <input type="file" name="file" id="file" class="inputfile" />
                            <label for="file">Choose a file</label>
                        </div>
                        <div class="profile-form col-lg-8 ">
                            <form action="">
                                <label for="name" class="text-white fw-semibold mb-2">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control mb-3" name="name" value="">

                                <label for="email" class="text-white fw-semibold mb-2">{{ __('Email') }}</label>
                                <p class="profile-subtitle mb-3">Joko@gmail.com</p>

                                <label for="username" class="text-white fw-semibold mb-2">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control mb-3" name="username" value="">

                                <label for="phone_number" class="text-white fw-semibold mb-2">{{ __('Phonenumber') }}</label>
                                <input id="phone_number" type="text" class="form-control mb-3" name="phone_number" value="">

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

        <div id="change-password" class="tab-name text-white" style="display: none;">
            <div class="d-flex justify-content-center">
                <div class="password-container">
                    <p class="fw-bold profile-title">
                        Change Password
                    </p>
                    <p class="profile-subtitle">Your password, your fortress. Make it strong, keep it safe.</p>

                    <div class="password-content row">
                        <form action="">
                            <label for="oldPassword" class="text-white fw-semibold mb-2">{{ __('Old Password') }}</label>
                            <input id="oldPassword" type="password" class="form-control mb-3" name="oldPassword" value="">

                            <label for="newPassword" class="text-white fw-semibold mb-2">{{ __('New Password') }}</label>
                            <input id="newPassword" type="password" class="form-control mb-3" name="newPassword" value="">

                            <label for="confirmPassword" class="text-white fw-semibold mb-2">{{ __('Confirm Password') }}</label>
                            <input id="confirmPassword" type="password  " class="form-control mb-3" name="confirmPassword" value="">

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
@endsection