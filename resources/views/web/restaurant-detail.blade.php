@extends('web.layouts.app')
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{$restaurantDetail[0]->name}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Restaurant</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1 style="color: #fd6e50;">About {{$restaurantDetail[0]->name}}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-body text-center" style="box-shadow: 0.1rem 0.1rem 1rem rgb(0 0 0 / 20%);">
                        <h6>Albondigas Soup</h6>
                        <!-- <p class="small"> A steaming cup or bowl of Mexican meatball &amp; vegetable soup garnished with crispy tortilla strips and fresh cheddar-Jack cheese. If you like Mexican food try this!</p> -->
                        <p>{{$restaurantDetail[0]->aboutUs}}</p>
                        <span class="float-right font-weight-bold">
                            <i class="fas fa-star" style="color: #fd7e14"></i>
                            <i class="fas fa-star" style="color: #fd7e14"></i>
                            <i class="fas fa-star" style="color: #fd7e14"></i>
                            <i class="fas fa-star" style="color: #fd7e14"></i>
                        </span>
                        <h5 class="text-uppercase mt-1">CLOSED until Mon 14:00</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1 style="color: #fd6e50;">{{$restaurantDetail[0]->name}} Products</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        @foreach($restaurantProducts as $key=>$data)
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <!-- <a href="{{'detail'}}"> -->
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                        </div>
                                                        <img src="{{asset($data->images)}}" class="img-fluid" alt="Image">
                                                    </div>
                                                    <div class="why-text">
                                                        <h4>{{$data->description}}</h4>
                                                        <p class="btn-holder">
                                                            <button type="button" value="{{$data->id}}"
                                                                class="btn btn-warning btn-block text-center cart add-to-cart" role="button">
                                                                Add to Cart (£{{$data->price}})
                                                            </button>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".add-to-cart").click(function() {
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "{{url('add-to-cart')}}",
                data: {
                    product_id:id,
                    _token:'{{csrf_token()}}',
            },
            success: function(response) {
                        alert('Product add to cart!');
                }
        });
    });
    });
</script>
