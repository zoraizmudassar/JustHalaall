@extends('web.layouts.app')
@section('title','Login')
@section('content')

    <div class="container">
        <div class="my-5">
            <div class="col-8 offset-2">
                <h1 class="title-left">Login Form</h1>
                <form class="mt-3 review-form-box collapse show" id="formRegister" style="">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="InputEmail1" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="InputPassword1" class="mb-0">Password</label>
                            <input type="password" class="form-control" id="InputPassword1" placeholder="Password">
                        </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Login</button>
                    <a href="{{'register'}}">Register?</a>
                </form>
            </div>
        </div>
    </div>
@endsection
