@extends('web.layouts.app')
@section('title','Register')
@section('content')
    <div class="container">
        <div class="my-5">
            <h1 class="title-left">Login Form</h1>
            <form class="mt-3 review-form-box collapse show" id="formRegister" style="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputName" class="mb-0">First Name</label>
                        <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputLastname" class="mb-0">Last Name</label>
                        <input type="text" class="form-control" id="InputLastname" placeholder="Last Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputEmail1" class="mb-0">Email Address</label>
                        <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputPassword1" class="mb-0">Password</label>
                        <input type="password" class="form-control" id="InputPassword1" placeholder="Password"> </div>
                </div>
                <button type="submit" class="btn hvr-hover">Register</button>
                <a href="{{'login'}}">Already Login?</a>
            </form>
        </div>
    </div>
@endsection
