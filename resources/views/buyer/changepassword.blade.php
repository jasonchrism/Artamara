@vite('resources/css/tabprofile.css')

@extends('layouts.app')

@section('content')

<div style="margin-top: 62px;">
    <ul class="nav nav-pills" id="myTab">
        <li class="nav-item tab-link">
            <a class="" href="/myprofile">Profile</a>
        </li>
        <li class="nav-item tab-link tab-active">
            <a class="" href="/myprofile/password">Change Password</a>
        </li>
        <li class="nav-item tab-link">
            <a class="" href="/myaddress">Address</a>
        </li>
    </ul>

    {{-- !-- View change password --> --}}
    <div id="change-password" class="tab-name text-white">
        <div class="d-flex justify-content-center">
            <div class="password-container">
                <p class="fw-bold profile-title">
                    Change Password
                </p>
                <p class="profile-subtitle">Your password, your fortress. Make it strong, keep it safe.</p>

                <div class="password-content row">
                    <form action="">

                            <label for="oldPassword" class="text-white fw-semibold mb-2">{{ __('Old Password') }}</label>

                        <div class="inputbox d-flex align-items-center mb-3">
                            <input id="oldPassword" type="password" class="form-control" name="oldPassword" value="">
                            <i class="fa-regular fa-eye" id="togglePassword"></i>
                        </div>
                        

                        <label for="newPassword" class="text-white fw-semibold mb-2">{{ __('New Password') }}</label>

                        <div class="inputbox d-flex align-items-center mb-3">
                            <input id="newPassword" type="password" class="form-control" name="newPassword" value="">
                            <i class="fa-regular fa-eye" id="togglePassword2"></i>
                        </div>

                        <label for="confirmPassword" class="text-white fw-semibold mb-2">{{ __('Confirm Password') }}</label>
                        <input id="confirmPassword" type="password" class="form-control mb-3" name="confirmPassword" value="">

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