@vite('resources/css/artist/myprofile.css')
@include('includes.addressNotification')

@extends('layouts.dashboard')

@section('title')
    My Profile
@endsection

@section('header_title')
    Welcome, {{ $artist->name }}
@endsection

@section('content')
    <ul class="nav nav-pills" id="myTab">
        <li class="nav-item tab-link">
            <a class="" href="/dashboard/artist/myprofile">Profile</a>
        </li>
        <li class="nav-item tab-link tab-active">
            <a class="" href="/dashboard/artist/myprofile/changepassword">Change Password</a>
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
                    <form action="{{ route('changeartistpassword.update') }}" method="post">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="oldPassword" class="text-white fw-semibold mb-2">{{ __('Old Password') }}</label>

                            <div class="inputerror d-flex flex-column">
                                <div class="inputbox d-flex align-items-center">
                                    <input id="oldPassword" type="password"
                                        class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword"
                                        value="">
                                    <i class="fas fa-eye" id="togglePassword"></i>
                                </div>
                                <div class="errormessage">
                                    @error('oldPassword')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div>
                            <label for="newPassword"
                                class="text-white fw-semibold mb-2 mt-3">{{ __('New Password') }}</label>

                            <div class="inputerror d-flex flex-column">
                                <div class="inputbox d-flex align-items-center">
                                    <input id="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid @enderror" name="newPassword"
                                        value="">
                                    <i class="fas fa-eye" id="togglePassword2"></i>
                                </div>
                                <div class="errormessage">
                                    @error('newPassword')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div>
                            <label for="confirmPassword"
                                class="text-white fw-semibold mb-2 mt-3">{{ __('Confirm Password') }}</label>
                            <input id="confirmPassword" type="password"
                                class="form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword"
                                value="">

                            @error('confirmPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="rightbutton d-flex justify-content-end mt-3">
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

    <!-- Javascript for eye toggle -->
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector('#oldPassword')


        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
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
            const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
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
