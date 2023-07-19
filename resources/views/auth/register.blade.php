@extends('web.layouts.app')
@section('title','Register')
@section('content')
    <div class="container">
        <div class="my-5">
            <h1 class="title-left">Registration Form</h1>
            <form class="mt-3 review-form-box collapse show" id="formRegister" style="" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputName" class="mb-0">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="InputName" placeholder="Full Name" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                        @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
{{--                    <div class="form-group col-md-6">--}}
{{--                        <label for="InputLastname" class="mb-0">Last Name</label>--}}
{{--                        <input type="text" class="form-control" id="InputLastname" placeholder="Last Name"> --}}
{{--                    </div>--}}
                    <div class="form-group col-md-6">
                        <label for="InputEmail1" class="mb-0">Email Address</label>
                        <input type="email" id="InputEmail1" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                        @error('email')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="InputPassword1" class="mb-0">Password</label>
                        <input type="password" id="InputPassword1" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                        @error('password')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="InputPassword1" class="mb-0">Confirm Password</label>
                        <input type="password" id="InputPassword2" placeholder="Confirm Password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>
                <button type="submit" class="btn hvr-hover">Register</button>
                <a href="{{ route('login') }}">Already Login?</a>
            </form>
        </div>
    </div>
@endsection
