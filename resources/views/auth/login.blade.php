@extends('layouts.auth')
@push('styles')
    @vite('resources/css/login.css')
@endpush

@section('title')
    Login
@endsection

@section('content')
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="bg-overlay-1 w-35 p-36">
                <a href="/"><img src="{{ asset('/assets/logo.svg') }}" alt="" class="mb-4"></a>
                <h4 class="text-white mb-4">Log in to collect art by the best artist in Indonesia</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
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
                        <input id="password" type="password" class="form-control mb-32 @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        {{ __('Log In') }}
                    </button>
                    <p class="d-flex justify-content-center text-white mb-0 fw-regular fs-12">Don't have an account?<a href="{{route('register')}}" class="ms-1 span-label">Sign Up</a></p>
                </form>

            </div>
        </div>
    </div>
@endsection
