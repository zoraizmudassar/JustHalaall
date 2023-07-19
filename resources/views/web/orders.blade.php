@extends('web.layouts.app')
@section('title','Orders')
@section('content')
    <div class="container">
        <div class="title-all text-center">
            <h1>My Orders</h1>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Restaurant</th>
                <th scope="col">Payment type</th>
                <th scope="col">Total</th>
                <th scope="col">Commission Percent</th>
                <th scope="col">Total Commission</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
                @if(count($orders)>0)
                @foreach ($orders as $index=>$item)
            <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$item->restaurant??''}}</td>
                <td>Card</td>
                <td>£{{$item->total??'0'}}</td>
                <td>£{{$item->commission_percent??'0'}}</td>
                <td>£{{$item->total_commission??'0'}}</td>
                <td>{{$item->order_date}}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7" style="text-align: center;">No Order Found!</td>
            </tr>
            @endif
            {{-- <tr>
                <th scope="row">2</th>
                <td>Desi Restaurant</td>
                <td>Cash on Collection</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Gourmet</td>
                <td>Online Payment/Credit Card</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>Glowfish Broast</td>
                <td>Cash on delivery</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>Dera Restaurant</td>
                <td>Cash on Collection</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr>
            <tr>
                <th scope="row">6</th>
                <td>Family Restaurant</td>
                <td>Online Payment/Credit Card</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr> --}}
            </tbody>
        </table>
    </div>
@endsection
