@extends('web.layouts.app')
@section('title', 'Category Products')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1 style="color: #fd6e50;">Category Related Products</h1>
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
                                        @foreach ($categoryProducts as $key => $data)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <!-- <a href="{{ 'detail' }}"> -->
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                        </div>
                                                        <img src="{{ asset($data->images) }}" class="img-fluid"
                                                            alt="Image">
                                                    </div>
                                                    <div class="why-text">
                                                        <h4>{{ $data->description }}</h4>
                                                        <div>
                                                            <p class="btn-holder">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-block text-center cart add-to-cart"
                                                                    role="button" id="addcart{{$data->id}}">
                                                                    Add to Cart (£{{ $data->price }})
                                                                </button>
                                                            </p>
                                                        </div>
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        <?php
    foreach ($categoryProducts as $item) {
    ?>
        $('#addcart<?php echo $item->id; ?>').click(function() {
            <?php if (auth()->user() != null) { ?>
            $.ajax({
                type: 'post',
                url: "{{ url('add-to-cart') }}",
                data: {
                    product_id: <?php echo $item->id; ?>,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                        alert('Product add to cart!');
                }
            });
            <?php } else { ?>
            alert('Please Login First!');
            <?php } ?>
        });
        <?php } ?>
    });
</script>
