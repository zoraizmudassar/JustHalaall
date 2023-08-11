@extends('restaurant.layouts.app')
@section('title','Add New Products')
@section('content')


    <style>
        .form-control{
            height: auto;
        }
        label{
            margin-top: 20px;
        }
    </style>
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Add New Product</h6>
                </div>
                <div class="card-body">
                    <form  class="add-product" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">Name</label>
                                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">Description</label>
                                        <input type="text" name="description" class="form-control form-control-sm" placeholder="Description">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">Price</label>  <small class="text-danger">(£)</small>
                                        <input type="text" name="price" class="form-control form-control-sm onlynumber" placeholder="Price">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
{{--                                        <label class="input-label" for="exampleFormControlInput1">Name</label>--}}
                                        <label for="sel1">Select Category</label>
                                        <select  name="category_id" class="form-control" id="sel1">
                                            @php $categories = \App\Models\Category::all(); @endphp
                                            <option selected="selected"  disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    <label>Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="customFileEg1" class="form-control" onchange="loadFile(event)">
                                        {{--                                    <label class="custom-file-label" for="customFileEg1"></label>--}}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">Delivery Time</label><small class="text-danger">(In Minute's)</small>
                                        <input type="text" name="delivery_time" id="delivery_time" class="form-control form-control-sm onlynumber" placeholder="Delivery Time">
                                        {{--                                    <span class="errmsg text-danger"></span>--}}
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <center>
                                            {{--                                        <img class="mt-3 restaurant-logo" style="width: 30%;border: 1px solid; border-radius: 10px;" id="output1" src="{{asset('assets/web/images/Patty Burger.jpg')}}" alt="image"/>--}}
                                            <img class="mt-3 product-logo" style="width: 30%;border: 1px solid; border-radius: 10px;"
                                                 id="output" src="{{asset('assets/admin/img/noImageSelected.jpg')}}" alt="image"/>
                                        </center>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        /*IMAGE*/
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        $(document).ready(function () {

            $(".onlynumber").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    // $(".errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
                }
            });
            /* START - AJAX code ADD restaurant */
            $('.add-product').on('submit',function (e){
                e.preventDefault();
                $('#addProductModal').modal('show');

                var data = $('.add-product');
                data = new FormData(data[0]);
                blockUi();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'{{route('restaurants.product.store')}}',
                    data:data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(data) {
                        $.unblockUI();
                        if(data.value === 1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "Product Add Successfully",
                                showConfirmButton: false,
                                timer: 3000
                            });
                            window.location.href = data.url;
                        }
                        if(data === 0){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "Something went wrong",
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error:function(data) {
                        console.log('error');
                        $.unblockUI();
                    }
                });
            });
            /* END - AJAX code ADD restaurant */
        });
        /* END - AJAX code ADD restaurant */
    </script>
    <script>
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            Swal.fire({
            icon: 'info',
            title: "Error!",
            text: "{{ session('message') }}",
        });
        break;
        case 'warning':
            Swal.fire({
            icon: 'warning',
            text: "{{ session('message') }}",
        });
        break;
        case 'success':
            Swal.fire({
            icon: 'success',
			title: 'Success',
            text: "{{ session('message') }}",
            showConfirmButton: false,
			timer: 3000
        });
        break;
        case 'error':
            Swal.fire({
            icon: 'error',
			title: 'Error',
            text: "{{ session('message') }}",
            showConfirmButton: false,
			timer: 3000
        });
        break;
    }
@endif
</script>
@endsection
