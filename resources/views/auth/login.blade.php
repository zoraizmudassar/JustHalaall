@extends('web.layouts.app')
@section('title', 'Login')
@section('content')

    <div class="container">
        <div class="my-5">
            <div class="col-8 offset-2">
                <h1 class="title-left">Login Form</h1>
                <form class="mt-3 review-form-box collapse show" id="formRegister" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-row">
                        @if (session('error'))
                            <div class="alert alert-danger" style="width: 100%;">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="form-group col-md-12">
                            <label for="InputEmail1" class="mb-0">Email Address</label>
                            <input type="email" id="InputEmail1" placeholder="Enter Email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="InputPassword1" class="mb-0">Password</label>
                            <input type="password" id="InputPassword1" placeholder="Password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Login</button>
                    <a href="{{ route('register') }}">Register?</a>
                    <div class="mt-5">

                        <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-primary btn-block">
                            Login with Facebook
                        </a>

                        <a href="{{ route('social.oauth', 'google') }}" class="btn btn-danger btn-block">
                            Login with Google
                        </a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
