@extends('web.layouts.app')
@section('title','Profile')
@section('content')
    <div class="container">
        <div class="title-all text-center">
            <img src="{{asset(Auth()->user()->image??'uploads/users/1636043641-img-3.jpg')}}" style="height: 200px; width:200px; border-radius:50%;" alt=""><h1>{{Auth()->user()->name??''}}</h1>
        </div>
        <table class="table table-hover">
            <tbody>
            <tr>
                <th><b>Email:</b></th>
                <td>{{Auth()->user()->email??''}}</td>
            </tr>
            <tr>
                <th><b>Phone:</b></th>
                <td>{{Auth()->user()->phone??''}}</td>
            </tr>
            <tr>
                <th><b>Address:</b></th>
                <td>{{Auth()->user()->address??''}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
