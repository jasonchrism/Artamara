@extends('layouts.auth')
@push('styles')
    @vite('resources/css/login.css')
@endpush

@section('title')
    Register
@endsection

@section('content')
    <div class="container py-5">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="bg-overlay-1 w-35 p-36">
                <a href="/"><img src="{{ asset('/assets/logo.svg') }}" alt="" class="mb-4"></a>
                <h4 class="text-white mb-4">Sign up now to collect art from Indonesia's top artists!</h4>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="text-white fw-semibold mb-2">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control mb-3 @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username" class="text-white fw-semibold mb-2">{{ __('Username') }}</label>
                        <input id="username" type="text" class="form-control mb-3 @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone-number" class="text-white fw-semibold mb-2">{{ __('Phone Number') }}</label>
                        <input id="phone-number" type="text" class="form-control mb-3 @error('phone-number') is-invalid @enderror"
                            name="phone-number" value="{{ old('phone-number') }}" required autocomplete="phone-number" placeholder="08192xxxx">
                        @error('phone-number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-white fw-semibold mb-2">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="johndoe@example.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="text-white fw-semibold mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control mb-3 @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role" class="text-white fw-semibold mb-2">{{ __('As') }}</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="role" id="role" aria-placeholder="Select Role">
                            <option selected>Select Role</option>
                            <option class="test" value="BUYER">Buyer</option>
                            <option value="ARTIST">Artist</option>
                          </select>
                    </div>


                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        {{ __('Sign Up') }}
                    </button>
                    <p class="d-flex justify-content-center text-white mb-0 fw-regular fs-12">Already have an account?<a href="{{route('login')}}" class="text-primary fw-semibold ms-1 fs-12">Log In</a></p>
                </form>

            </div>
        </div>
    </div>
@endsection
