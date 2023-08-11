@extends('restaurant.layouts.app')
@section('title','Rejected Product')
@section('content')
    <style>
        label{
            margin-top: 20px;
        }
    </style>
    <!-- START - DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between">
            <div class="row justify-content-between align-items-center">
                <h6 class="ml-3 font-weight-bold">Restaurants Products</h6>
                {{--                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addProductModal"><i class="fa fa-plus"></i> Add New Product</button>--}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 145px;">Name</th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 145px;">Description</th>
                                    {{--                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 224px;">Name</th>--}}
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">Price</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">Availablity</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">Featured</th>
                                    {{--                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">Category Name</th>--}}
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 43px;">Status</th>
                                    {{--                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 96px;">Status</th>--}}
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 85px;">Image</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 85px;">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($products as $res)
                                    <tr class="odd">
                                        <td class="sorting_1">{{$res->name}}</td>
                                        <td>{{$res->description}}</td>
                                        <td>{{$res->price}}</td>
                                        <td>
                                            <input data-id="{{$res->id}}" id="check" class="toggle-class" type="checkbox" data-onstyle="warning" data-offstyle="danger" data-toggle="toggle" data-on="Available" data-off="UnAvailble" {{ $res->is_available == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input data-id="{{$res->id}}" id="check" class="toggle-class-feature" type="checkbox" data-onstyle="success" data-offstyle="warning" data-toggle="toggle" data-on="Featured" data-off="UnFeatured" {{ $res->is_featured == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{$res->status}}
                                        </td>
                                        <td>
                                            <img src="{{!empty($res->images) ? asset($res->images) : ""}}" class="product-img embed-responsive" data-image="{{$res->images}}">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" style="background: #ff982f;border: none"  data-id="{{$res}}" class="btn btn-sm btn-success edit-product-btn"><i class="fa fa-pencil-alt"></i></button>
                                                <button type="button" data-id="{{$res->id}}" class="btn btn-sm btn-danger delete-category-btn"><i class="fa fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END - DataTales Example -->

    <!-- START - Add Restaurant Modal -->


    <!-- START - Edit Restaurant Modal -->
    <div class="modal fade bd-example-modal-lg" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form  class="edit-deal" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Description</label>
                                    <input type="text" name="description" id="description" class="form-control form-control-sm" placeholder="Description">
                                    <input type="hidden" name="product_id" id="product_id">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Price</label>  <small class="text-danger">(£)</small>
                                    <input type="text" name="price" id="price" class="form-control form-control-sm" placeholder="Price">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{--                                        <label class="input-label" for="exampleFormControlInput1">Name</label>--}}
                                    <label for="sel1">Select Category</label>
                                    <select  name="category_id"  id="category_id" class="form-control" id="sel1">
                                        @php $categories = \App\Models\Category::all(); @endphp
                                        <option selected="selected"  disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id ? $category->id : ''}}" >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-6">
                                <label>Image</label>
                                <div class="custom-file">
                                    <input type="file" style="height: auto" name="image" id="customFileEg1" class="form-control" onchange="loadFile(event)">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Delivery Time</label><small class="text-danger">(In Minute's)</small>
                                    <input type="text" name="delivery_time" id="delivery_time" class="form-control form-control-sm" placeholder="Delivery Time">
                                    {{--                                    <input type="hidden" name="category_id" id="category-id">--}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <center>
                                        <img class="mt-3 product-logo" style="width: 30%;border: 1px solid; border-radius: 10px;"
                                             id="output1" src="" alt="image"/>
                                    </center>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-warning update-restaurant" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END - Edit Restaurant Modal -->

    <!-- START - Delete Restaurant Modal -->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Confirmation</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button"  id="ok_button"  class="btn btn-danger ok_button">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END - Delete Restaurant Modal -->
@endsection
@section('script')
    <script>
        /* START - AJAX code add/edit/delete */
        $(document).ready(function(){
            $("#delivery_time").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    // $(".errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
                }
            });
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                // blockUi();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'{{url('/restaurant/product/change-status')}}',
                    data:{'_token': '{{ csrf_token() }}','status': status, 'user_id': user_id},
                    // cache: false,
                    // contentType: false,
                    // processData: false,
                    success:function(data) {
                        // $.unblockUI();
                        if(data.status === 1){
                            successMsg(data.message);
                            // $('#addUserModal').modal('hide');
                            // $('#addRestaurantModal').modal('toggle');
                            // window.location.href = data.url;
                            window.location.reload();
                        }
                        if(data.status === 0){
                            errorMsg(data.message);
                        }
                    },
                    error:function(data) {
                        console.log('error');
                        // $.unblockUI();
                    }
                });
            });

            $('.toggle-class-feature').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                // blockUi();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'{{url('/restaurant/product/change-feature')}}',
                    data:{'_token': '{{ csrf_token() }}','status': status, 'user_id': user_id},
                    success:function(data) {
                        if(data.status === 1){
                            successMsg(data.message);
                            window.location.reload();
                        }
                        if(data.status === 0){
                            errorMsg(data.message);
                        }
                    },
                    error:function(data) {
                        console.log('error');
                    }
                });
            });
            /* START - AJAX code ADD restaurant */
            {{--$('.add-product').on('submit',function (e){--}}
            {{--    e.preventDefault();--}}
            {{--    var data = $('.add-product');--}}
            {{--    data = new FormData(data[0]);--}}
            {{--    blockUi();--}}
            {{--    $.ajax({--}}
            {{--        type:'POST',--}}
            {{--        dataType:'json',--}}
            {{--        url:'{{route('restaurants.product.store')}}',--}}
            {{--        data:data,--}}
            {{--        cache: false,--}}
            {{--        contentType: false,--}}
            {{--        processData: false,--}}
            {{--        success:function(data) {--}}
            {{--            $.unblockUI();--}}
            {{--            if(data.status === 1){--}}
            {{--                successMsg(data.message);--}}
            {{--                $('#addProductModal').modal('hide');--}}
            {{--                // $('#addRestaurantModal').modal('toggle');--}}
            {{--                // window.location.href = data.url;--}}
            {{--                window.location.reload();--}}
            {{--            }--}}
            {{--            if(data.status === 0){--}}
            {{--                errorMsg(data.message);--}}
            {{--            }--}}
            {{--        },--}}
            {{--        error:function(data) {--}}
            {{--            console.log('error');--}}
            {{--            $.unblockUI();--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
            /* END - AJAX code ADD restaurant */

            /* START - AJAX code EDIT restaurant */
            $('.edit-product-btn').click(function (e) {
                //--- get object & parse into Javascript object
                var data = JSON.parse($(this).attr('data-id'));



                $('#editProductModal').modal('show');

                //--- set values from that object
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#price').val(data.price);
                $('#category_id').val(data.category_id);
                $('#product_id').val(data.id);
                $('#delivery_time').val(data.delivery_time);
                $('.product-logo').attr("src",'{{asset('')}}'+data.images);

                //--- EDIT AJAX Code
                $('.edit-deal').submit(function (e) {
                    e.preventDefault();
                    var data = $('.edit-deal');
                    data = new FormData(data[0]);

                    /*--- START - Update Record Ajax code */
                    blockUi();
                    $.ajax({
                        type: 'POST',
                        url: '{{route('restaurants.product.update')}}',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $.unblockUI();
                            if (data.status === 200) {
                                successMsg(data.message);
                                $('#editProductModal').modal('hide');
                                window.location.reload();
                            }
                            if (data.status === 0) {
                                errorMsg(data.message);
                            }
                        },
                        error: function (data) {
                            console.log('error');
                            $.unblockUI();
                        }
                    });
                    /*--- END - Update Record Ajax code */
                });
            });
            /* END - AJAX code EDIT restaurant */

            /* START - AJAX code DELETE restaurant */
            var data_id;
            $('.delete-category-btn').click(function (e) {
                //--- get object & parse into Javascript object
                data_id = JSON.parse($(this).attr('data-id'));
                $('#confirmModal').modal('show');
            });
            //--- DELETE AJAX Code
            $('#ok_button').click(function(){
                var data = { "_token": "{{@csrf_token()}}", "data_id": data_id };
                blockUi();
                $.ajax({
                    type:'POST',
                    url:'{{route('restaurants.product.delete')}}',
                    data:data,
                    success:function (data){
                        $.unblockUI();
                        if(data.status === 1){
                            successMsg(data.message);
                            $('#confirmModal').modal('hide');
                            window.location.reload();
                        }
                        if(data.status === 0){
                            errorMsg(data.message);
                        }
                    },
                    error:function (data){
                        console.log('error');
                        $.unblockUI();
                    }
                });
            });
            /* END - AJAX code DELETE restaurant */
        });

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var loadFile = function(event) {
            var output = document.getElementById('output1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        /* END - AJAX code add/edit/delete */
    </script>
@endsection
