@extends('layouts.auth')
@push('styles')
    @vite('resources/css/login.css')
@endpush

@section('title')
    Register
@endsection

@section('content')
    {{-- @if ($errors->any())
        {{ dd($errors) }}
    @endif --}}
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="bg-overlay-1 wrapper">
                <a href="/"><img src="{{ asset('/assets/logo.svg') }}" alt="" class="mb-4"></a>
                <h4 class="text-white mb-4">Sign up now to collect art from Indonesia's top artists!</h4>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="text-white fw-semibold mb-2">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control mb-3 @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username" class="text-white fw-semibold mb-2">{{ __('Username') }}</label>
                        <input id="username" type="text"
                            class="form-control mb-3 @error('username') is-invalid @enderror" name="username"
                            value="{{ old('username') }}" required autocomplete="off" placeholder="username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone-number" class="text-white fw-semibold mb-2">{{ __('Phone Number') }}</label>
                        <input id="phone-number" type="text"
                            class="form-control mb-3 @error('phone_number') is-invalid @enderror" name="phone_number"
                            value="{{ old('phone_number') }}" required autocomplete="off" placeholder="08192xxxx">
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-white fw-semibold mb-2">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="off"
                            placeholder="johndoe@example.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="text-white fw-semibold mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" placeholder="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm"
                            class="text-white fw-semibold mb-2">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password"
                            class="form-control mb-3 @error('password') is-invalid @enderror" name="password_confirmation"
                            required autocomplete="new-password" placeholder="password">
                    </div>

                    <div class="form-group">
                        <label for="role" class="text-white fw-semibold mb-2">{{ __('As') }}</label>
                        <select class="form-select mb-3 @error('role') is-invalid @enderror" aria-label="Default select example" name="role" id="role"
                            aria-placeholder="Select Role">
                            <option selected>Select Role</option>
                            <option value="BUYER">Buyer</option>
                            <option value="ARTIST">Artist</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="artist" id="artist" style="display: none">
                        <div class="form-group">
                            <label for="about" class="text-white fw-semibold mb-2">{{ __('About') }}</label>
                            <textarea id="about" type="text" class="form-control mb-3 @error('about') is-invalid @enderror" name="about"
                                value="{{ old('about') }}" autocomplete="off" placeholder="describe your profile"></textarea>
                            @error('about')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="identity-card"
                                class="text-white fw-semibold mb-2">{{ __('Identity Card') }}</label>
                            <input id="identity-card" type="file"
                                class="form-control mb-3 @error('id_photo') is-invalid @enderror" name="id_photo"
                                value="{{ old('id_photo') }}" autocomplete="off">
                            @error('id_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="street" class="text-white fw-semibold mb-2">{{ __('Street') }}</label>
                            <input id="street" type="text"
                                class="form-control mb-3 @error('street') is-invalid @enderror" name="street"
                                value="{{ old('street') }}" autocomplete="street"
                                placeholder="street">
                            @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row gx-2">
                            <div class="form-group col">
                                <label for="province" class="text-white fw-semibold mb-2">{{ __('Province') }}</label>
                                <input id="province" type="text"
                                    class="form-control mb-3 @error('province') is-invalid @enderror" name="province"
                                    value="{{ old('province') }}" autocomplete="off`" placeholder="province">
                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="city" class="text-white fw-semibold mb-2">{{ __('City') }}</label>
                                <input id="city" type="text"
                                    class="form-control mb-3 @error('city') is-invalid @enderror" name="city"
                                    value="{{ old('city') }}" autocomplete="city" placeholder="city">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row gx-2">
                            <div class="form-group col">
                                <label for="district" class="text-white fw-semibold mb-2">{{ __('District') }}</label>
                                <input id="district" type="text"
                                    class="form-control mb-3 @error('district') is-invalid @enderror" name="district"
                                    value="{{ old('district') }}" autocomplete="district" placeholder="district">
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="postal-code"
                                    class="text-white fw-semibold mb-2">{{ __('Postal Code') }}</label>
                                <input id="postal-code" type="text"
                                    class="form-control mb-3 @error('postal_code') is-invalid @enderror"
                                    name="postal_code" value="{{ old('postal_code') }}" autocomplete="postal code"
                                    placeholder="postal-code">
                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="text-white fw-semibold mb-2">{{ __('Description') }}</label>
                            <input id="description" type="text"
                                class="form-control mb-32 @error('description') is-invalid @enderror" name="description"
                                value="{{ old('description') }}" autocomplete="description"
                                placeholder="detail your address">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        {{ __('Sign Up') }}
                    </button>
                    <p class="d-flex justify-content-center text-white mb-0 fw-regular fs-12">Already have an account?<a
                            href="{{ route('login') }}" class="ms-1 span-label">Log In</a></p>
                </form>

            </div>
        </div>
    </div>
    @vite('resources/js/register.js');
@endsection
