@extends('restaurant.layouts.app')
@section('title','Rejected Orders')
@section('content')
    <!-- START - DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between">
            <div class="row justify-content-between align-items-center">
                <h6 class="ml-3 font-weight-bold">Rejected Orders</h6>
                {{--                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i> Add New Product</button>--}}
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
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 70px;">Order Id</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">UserName</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">Payment Type</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 43px;">Approval Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 85px;">Place Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 30px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $res)
                                    <tr class="odd">
                                        <td class="sorting_1">{{$res->id}}</td>
                                        <td>{{ $res->user->name }}</td>
{{--                                        <td>{{$res->user->name}}</td>--}}
                                        <td>{{ ucfirst($res->payment_type) }}</td>
                                        <td>
                                            @php $statuses = \App\Models\Status::all(); @endphp
                                            <select data-id="{{$res->id}}" class="custom-select custom-select-sm statusSet" aria-label="Select Status">
                                                @foreach($statuses as $status)
                                                    <option value="{{$status->id}}" {{ $res->status_id == $status->id ? "selected" : $res->status_id == 4 }}>{{$status->status}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            {{$res->created_at->toFormattedDateString()}}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('restaurant.order.orderDetails',$res->id)}}" class="btn btn-sm btn-primary detail-order-btn"><i class="fas fa-eye"></i></a>
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
    <div class="modal fade bd-example-modal-lg" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Detail's</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form  class="detail-form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Total Price</label>
                                    <input type="text" name="total_price" id="total_price" value="" class="form-control form-control-sm" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Payment Status</label>
                                    <input type="text" name="payment_status" value="" id="payment_status" class="form-control form-control-sm" disabled>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label">Total Commission</label>
                                    <div>
                                        <input type="text" name="total_commission"  id="total_commission" class="form-control form-control-sm" value="" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Delivery Charges</label>
                                    <input type="text" name="delivery_charges" value="" id="delivery_charges" class="form-control form-control-sm" disabled>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <input type="hidden" name="id" value="" id="restaurant-id">
                            <div class="col-12">
                                <div class="form-group">
                                    <span id="store_image">

                                    </span>
                                    {{--                                    <center>--}}
                                    {{--                                        <img class="mt-3" style="width: 30%;border: 1px solid; border-radius: 10px;" id="output"--}}
                                    {{--                                             src="{{asset('assets/web/images/Patty Burger.jpg')}}" alt="image"/>--}}
                                    {{--                                    </center>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- START - Add Restaurant Modal -->
    <div class="modal fade bd-example-modal-lg" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form  class="add-product" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Name</label>
                                    <input type="text" name="name" class="form-control form-control-sm" placeholder="EX : Desi">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Type</label>
                                    <input type="text" name="type" class="form-control form-control-sm" placeholder="EX : Pakistani">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END - Add Restaurant Modal -->

    <!-- START - Edit Restaurant Modal -->
    <div class="modal fade bd-example-modal-lg" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form  class="edit-product" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1"></label>
                                    <input type="text" name="name" class="form-control form-control-sm" id="name" value="" placeholder="Product Name" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1"></label>
                                    <input type="text" name="description" id="description" class="form-control form-control-sm" placeholder="Description">

                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1"></label>
                                    <input type="text" name="price" id="price" class="form-control form-control-sm" placeholder="Price">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"></label>
                                    <div>
                                        <input type="text" name="delivery_time"  id="delivery_time" class="form-control form-control-sm" placeholder="Delivery time">
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="col-12">--}}
                            {{--                            --}}
                            {{--                                <div class="form-group">--}}
                            {{--                                    <label class="input-label"></label>--}}
                            {{--                                    <div class="col-12 pr-2 pl-0">--}}
                            {{--                                        <input type="text" name="delivery_charges" id="delivery_charges" class="form-control form-control-sm" placeholder="Delivery charges">--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>

                        {{--                        <div class="row mb-3">--}}
                        {{--                            --}}{{----}}
                        {{--                            <div class="col-6">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label class="input-label"--}}
                        {{--                                           for="status">{{t('messages.status')}}</label>--}}
                        {{--                                    <select id="status" class="js-select2-custom" name="status">--}}
                        {{--                                        <option value="1">{{t('messages.active')}}</option>--}}
                        {{--                                        <option value="0">{{t('messages.disabled')}}</option>--}}
                        {{--                                    </select>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            --}}
                        {{--                            <div class="col-6">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label class="input-label" for=""></label>--}}
                        {{--                                    <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Ex : Lahore Pakistan">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col-6">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label class="input-label"></label>--}}
                        {{--                                    <div class="d-flex">--}}
                        {{--                                        <div class="col-6 pr-2 pl-0">--}}
                        {{--                                            <input type="time" name="start_time" id="start_time" class="form-control form-control-sm" placeholder="Start Time">--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="col-6 pl-2 pr-0">--}}
                        {{--                                            <input type="time" name="end_time" id="end_time" class="form-control form-control-sm" placeholder="End Time">--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}

                        {{--                        </div>--}}
                        <div class="row mb-3">

                            <div class="col-6">
                                <label></label><small style="color: red">* </small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input" onchange="editLoadFile(event)">
                                    <label class="custom-file-label" for="customFileEg1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <center>
                                        <img class="mt-3 product-image"  style="width: 30%;border: 1px solid; border-radius: 10px;"
                                             id="output1" src="{{ asset('assets/admin/img/noImageSelected.jpg') }}" alt="image"/>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="" id="restaurant-id">
                            <div class="col-12">
                                <div class="form-group">
                                    <span id="store_image">

                                    </span>
                                    {{--                                    <center>--}}
                                    {{--                                        <img class="mt-3" style="width: 30%;border: 1px solid; border-radius: 10px;" id="output"--}}
                                    {{--                                             src="{{asset('assets/web/images/Patty Burger.jpg')}}" alt="image"/>--}}
                                    {{--                                    </center>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary update-restaurant" type="submit">Submit</button>
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

            $('.statusSet').change(function() {
                const statusNum = $(this).val();
                var order_id = $(this).attr('data-id');

                //blockUi();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'{{route('restaurants.order.changeStatus-order')}}',
                    data:{'_token': '{{ csrf_token() }}','status': statusNum, 'order_id': order_id},
                    // cache: false,
                    // contentType: false,
                    // processData: false,
                    success:function(data) {
                        // $.unblockUI();
                        if(data.status === 200){
                            successMsg(data.message);
                            // $('#addUserModal').modal('hide');
                            // $('#addRestaurantModal').modal('toggle');
                            // window.location.href = data.url;
                            window.location.reload();
                        }
                        if(data.status === 404){
                            errorMsg(data.message);
                        }
                    },
                    error:function(data) {
                        console.log('error');
                        // $.unblockUI();
                    }
                });
                // $.ajax({
                // type: "GET",
                // dataType: "json",
                // url: '/changeStatus',
                // data: {'status': status, 'user_id': user_id},
                // success: function(data){
                // console.log(data.success)
                // }
                // });
            });
            /* START - AJAX code ADD restaurant */
            $('.add-product').on('submit',function (e){
                e.preventDefault();
                var data = $('.add-product');
                data = new FormData(data[0]);
                blockUi();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    {{--                    url:'{{route('admin.category.store')}}',--}}
                    data:data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(data) {
                        $.unblockUI();
                        if(data.status === 1){
                            successMsg(data.message);
                            $('#addCategoryModal').modal('hide');
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
                        $.unblockUI();
                    }
                });
            });
            /* END - AJAX code ADD restaurant */
            $('.detail-order-btn').click(function (e) {
                //--- get object & parse into Javascript object
                var data = JSON.parse($(this).attr('data-id'));
                console.log(data)
                var totalAmount = ($(this).attr('data-totalAmount'));
// console.log(data.orderDetails);
// return;
                $('#detailModal').modal('show');

                $('#total_price').val(totalAmount);
                $('#total_commission').val(data.order_details.total_commission);
                $('#delivery_charges').val(data.order_details.delivery_charges);
                $('#payment_status').val(data.status.status.toUpperCase());

            });
            /* START - AJAX code EDIT restaurant */
            $('.edit-product-btn').click(function (e) {
                //--- get object & parse into Javascript object
                var data = JSON.parse($(this).attr('data-id'));

                $('#editProductModal').modal('show');

                //--- set values from that object
                $('#name').val(data.name);
                $('#type').val(data.categoryable_type);
                $('#product_id').val(data.id);
                $('#delivery_time').val(data.delivery_time);
                // console.log(data.price);
                return;
                $('.product-image').attr("src",'{{asset('')}}'+data.images.image);

                //--- EDIT AJAX Code
                $('.edit-category').submit(function (e) {
                    e.preventDefault();
                    var data = $('.edit-category');
                    data = new FormData(data[0]);

                    /*--- START - Update Record Ajax code */
                    blockUi();
                    $.ajax({
                        type: 'POST',
                        {{--                        url: '{{route('admin.category.update')}}',--}}
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $.unblockUI();
                            if (data.status === 1) {
                                successMsg(data.message);
                                $('#editCategoryModal').modal('hide');
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
                    {{--                    url:'{{route('admin.category.delete')}}',--}}
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
        /* END - AJAX code add/edit/delete */
    </script>
@endsection
