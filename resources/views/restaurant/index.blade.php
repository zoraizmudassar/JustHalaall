@extends('restaurant.layouts.app')
@section('title','Restaurant Dashboard')
@section('content')
<style>
.wrapper{
    width:100%;
    display:block;
    overflow:hidden;
    margin:0 auto;
    padding: 60px 50px;
    background:#fff;
    border-radius:4px;
}

canvas{
    background:#fff;
    height:400px;
}
a:hover{
    text-decoration: none;
}
#dataTable_info{
    padding-bottom: 15px;
    padding-top: 10px;
}
#dataTable_paginate{
    padding-bottom: 15px;
    padding-top: 10px;
}
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4 px-3 py-2" style="background-color: #ff982f; border-radius: 0.25rem;">
    <h1 class="h3 mb-0 text-white">Dashboard</h1>
</div>
<div class="row">
    <div class="d-sm-flex align-items-center justify-content-between mb-1 px-3 py-2">
        <h1 class="h4 mb-0 text-dark">Orders</h1>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('restaurants.product.pending')}}" style="text-decortion: none;">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">New Order's (Pending)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::where(['status'=>'pending', 'restaurant_id'=>Auth::id()])->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-hourglass-end fa-2x text-info-300" style="color: #f6c23e!important;"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('restaurants.deal.enable')}}">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Order (Accepted)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Deal::where(['status'=>'1', 'restaurant_id'=>Auth::id()])->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bookmark fa-2x text-info-300" style="color: #5a5c69!important;"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('restaurants.order.pending-order')}}">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order (Make Order On Way)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Order::where('status',1)->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shipping-fast fa-2x text-info-300" style="color: #36b9cc!important;"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('restaurants.order.complete-order')}}">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Order's (Completed)</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::where('status',3)->count()}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-check-circle fa-2x text-info-300" style="color: #1cc88a!important;"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="d-sm-flex align-items-center justify-content-between mb-1 px-3 py-2">
        <h1 class="h5 mb-0 text-dark">Products</h1>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('restaurants.product.pending')}}">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Product (Pending)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::where(['status'=>'rejected', 'restaurant_id'=>Auth::id()])->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-hourglass-end fa-2x text-danger-300" style="color: #f6c23e!important;"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('restaurants.product.pending')}}">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Products (Accepted)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::where(['restaurant_id'=>Auth::id()])->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bookmark fa-2x text-dark-300" style="color: #5a5c69!important"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('restaurants.product.pending')}}">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New Deals (Enabled)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::where(['status'=>'Make Order On Way', 'restaurant_id'=>Auth::id()])->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-gift fa-2x text-info-300" style="color: #36b9cc!important;"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('restaurants.product.pending')}}">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Products</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::where(['status'=>'accepted', 'restaurant_id'=>Auth::id()])->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-success-300" style="color: #1cc88a!important;"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
<div class="row mt-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-2 px-3 py-2">
        <h1 class="h4 mb-0 text-dark">Orders History</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-4">
        <div class="wrapper">
            <canvas id="myChart4"></canvas>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-2 px-3 py-2">
        <h1 class="h4 mb-0 text-dark">Recent Orders</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-5">
        <div class="wrapper">
            <div class="table-responsive">
                <table class="table dataTable table-hover" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col">Order No</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price (£)</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            <th scope="col">Status Approval</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <th scope="row">1</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>34</td>
                            <td>London</td>
                            <td><span class="badge badge-warning p-2">Make Order On Way</span></td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                @foreach($statuses as $status)
                                    <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>34</td>
                            <td>London</td>
                            <td><span class="badge badge-success p-2">Complete</span></td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>34</td>
                            <td>London</td>
                            <td><span class="badge badge-primary p-2">Primary</span></td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select  class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>87</td>
                            <td>London</td>
                            <td>
                                <span class="badge badge-warning p-2">Make Order On Way</span>
                            </td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select  class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>23</td>
                            <td>London</td>
                            <td>
                                <span class="badge badge-primary p-2">Primary</span>
                            </td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select  class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>34</td>
                            <td>London</td>
                            <td>
                                <span class="badge badge-success p-2">Accepted</span>
                            </td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>76</td>
                            <td>London</td>
                            <td>
                                <span class="badge badge-success p-2">Accepted</span>
                            </td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>23</td>
                            <td>London</td>
                            <td>
                                <span class="badge badge-primary p-2">Primary</span>
                            </td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">8</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>12</td>
                            <td>London</td>
                            <td>
                                <span class="badge badge-danger p-2">Rejected</span>
                            </td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select  class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">9</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>86</td>
                            <td>London</td>
                            <td>
                                <span class="badge badge-danger p-2">Rejected</span>
                            </td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">10</th>
                            <td>Zoraiz Mudassar</td>
                            <td>Zinger Burger</td>
                            <td>44</td>
                            <td>London</td>
                            <td>
                                <span class="badge badge-success p-2">Accepted</span>
                            </td>
                            <td>
                                @php $statuses = ['pending','approved','rejected']; @endphp
                                <select class="custom-select custom-select-sm statusSet text-center" aria-label="Select Status">
                                    @foreach($statuses as $status)
                                        <option value="{{$status}}" >{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-dark">Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
    var ctx = document.getElementById("myChart4").getContext('2d');
    var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: ["01-Jun","02-Jun","03-Jun","04-Jun","05-Jun","06-Jun","07-Jun","08-Jun","09-Jun","10-Jun","11-Jun","12-Jun","13-Jun","14-Jun","15-Jun","01-Jun","02-Jun","03-Jun","04-Jun","05-Jun","06-Jun","07-Jun","08-Jun","09-Jun","10-Jun","11-Jun","12-Jun","13-Jun","14-Jun","15-Jun"],
		datasets: [{
			label: 'Pending',
			backgroundColor: "#FFFF00",
			data: [12, 59, 5, 56, 45, 10, 4, 56, 45, 12, 5, 56, 45, 4, 24, 12, 59, 5, 56, 45, 10, 4, 56, 45, 12, 5, 56, 45, 4, 24],
		}, {
			label: 'Make Order On Way',
			backgroundColor: "#232f5b",
			data: [12, 12, 59, 85, 23, 35, 7, 16, 45, 12, 5, 26, 45, 20, 4, 12, 59, 5, 56, 45, 10, 4, 56, 45, 12, 5, 56, 45, 4, 24],
		}, {
			label: 'Complete',
			backgroundColor: "#228B22",
			data: [12, 12, 59, 12, 74, 3, 55, 31, 45, 4, 5, 56, 45, 10, 4, 12, 59, 5, 56, 45, 10, 4, 56, 45, 12, 5, 56, 45, 4, 24],
		},{
			label: 'Accepted',
			backgroundColor: "#20B2AA",
			data: [12, 58, 12, 59, 44, 5, 22, 56, 45, 32, 5, 36, 45, 10, 14, 12, 59, 5, 56, 45, 10, 4, 56, 45, 12, 5, 56, 45, 4, 24],
		}],
	},
    options: {
        tooltips: {
        displayColors: true,
        callbacks:{
            mode: 'x',
        },
        },
        scales: {
        xAxes: [{
            stacked: true,
            gridLines: {
            display: false,
            }
        }],
        yAxes: [{
            stacked: true,
            ticks: {
            beginAtZero: true,
            },
            type: 'linear',
        }]
        },
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: 'bottom' },
        }
    });
</script>
@endsection