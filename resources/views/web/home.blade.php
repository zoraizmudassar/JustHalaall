@extends('web.layouts.app')
@section('title','Home Page')
@section('content')
    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="{{asset('assets/web/images/banner-1.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Just Halaall</strong></h1>
                            <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">

                <img src="{{asset('assets/web/images/banner-2.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Just Halaall</strong></h1>
                            <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{asset('assets/web/images/banner-3.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Just Halaall</strong></h1>
                            <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($foodCategory as $key=>$data)
                <?php
                    $catogoryId=$data->id;
                ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <a href="{{ url('categoryproducts/'.$data->id) }}">
                        <div class="blog-box">
                            <div class="blog-img">
                                <img class="img-fluid" style="width: 100%;" src="{{asset($data->image??'assets\web\images\category.jpeg')}}" alt="" />
                            </div>
                            <div class="blog-content">
                                <div class="title-blog">
                                    <h3>{{$data->name}}</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Categories -->

    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Restaurants</h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                @foreach($resturant as $key=>$data)
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <a href="{{ url('restaurant-detail/'.$data->id) }}">
                        <div class="blog-box">
                            <div class="blog-img">
                                <img class="img-fluid" style="width: 100%;" src="{{asset($data->logo??'assets\web\images\rest.jpeg')}}" alt="" />
                            </div>
                            <div class="blog-content">
                                <div class="title-blog">
                                    <h3>{{$data->name}}</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Blog  -->
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row" style="width: 100%;">
                        <div class="col-md-11">
                            <h2 class="modal-title" style="text-align: center;">Just Halaall</h2>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h3>Food just what your body needs </h3>
                    {{-- <h3>Halaall Food</h3> --}}
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        var alerted = localStorage.getItem('alerted') || '';
    if (alerted != 'yes') {
        $('.modal').modal('show');
    }
    localStorage.setItem('alerted','yes');
});
    // $(document).ready(function() {
    //     console.log('hy its me')
    //     $('.modal').modal('show');
    // })
    // $(window).load(function() {
    //     $('#modal').modal('show');
    // });
</script>
