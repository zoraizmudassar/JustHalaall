@extends('admin.layouts.app')
@section('title','Restaurants Report')
@section('content')

    <!-- START - DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between">
            <div class="row justify-content-between align-items-center">
                <h6 class="ml-3 font-weight-bold">Restaurants Report</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable text-center" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 145px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 224px;">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">Phone</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 85px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($restaurants as $res)
                                    <tr class="odd">
                                        <td class="sorting_1">{{$res->name}}</td>
                                        <td>{{$res->email}}</td>
                                        <td>{{$res->phone}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="report-detail/{{$res->id}}">
                                                    <button type="button" style="background: #ff982f;border: none" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></button>
                                                </a>
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
    <div class="modal fade bd-example-modal-lg" id="addRestaurantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Restaurant</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form  class="add-restaurant" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Enter Restaurant Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter Restaurant Email" autocomplete="false">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control form-control-sm" placeholder="Enter Restaurant Phone">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control form-control-sm" placeholder="Enter Password" autocomplete="false">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control form-control-sm" placeholder="Enter Restaurant Address">
                                </div>
                            </div>
                            <hr>
                            <div class="col-6 d-flex">
                                <div class="form-group">
                                    <label>Delivery Time</label>
                                    <div class="col-12 pr-10 pl-0">
                                        <input type="text" name="delivery_time" class="form-control form-control-sm" placeholder="Enter Delivery time">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Delivery Charges</label>
                                    <div class="col-12 pr-2 pl-0">
                                        <input type="text" name="delivery_charges" class="form-control form-control-sm" placeholder="Enter Delivery charges">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="col-6 pr-2 pl-0">
                                            <label>Start Time</label>
                                            <input type="time" name="start_time" class="form-control form-control-sm" placeholder="Enter Start Time">
                                        </div>
                                        <div class="col-6 pl-2 pr-0">
                                            <label>Close Time</label>
                                            <input type="time" name="end_time" class="form-control form-control-sm" placeholder="Enter End Time"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label></label><small>Restaurant Image </small>
                                <div class="custom-file">
{{--                                    <input type="file" name="logo" id="customFileEg1" class="form-control">--}}
{{--                                    <input type="file" name="logo" id="customFileEg1" class="custom-file-input">--}}
                                    <input type="file" name="logo" style="height: auto;" id="customFileEg1" class="form-control" onchange="loadFile(event)">
{{--                                    <label class="custom-file-label" for="customFileEg1"></label>--}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <center>
                                        <img class="mt-3" style="width: 30%;border: 1px solid; border-radius: 10px;"
                                             id="output" src="{{ asset('assets/admin/img/noImageSelected.jpg') }}" alt="image"/>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" style="background: #ff982f;border: none;color: #fff;" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-light" style="background: #ff982f;border: none;color: #fff;" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END - Add Restaurant Modal -->

    <!-- START - Edit Restaurant Modal -->
    <div class="modal fade bd-example-modal-lg" id="editRestaurantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Restaurant</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form  class="edit-restaurant" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="t" for="exampleFormControlInput1">Name</label>
                                    <input type="text" name="name" class="form-control form-control-sm" id="name" value="" placeholder="Enter Restaurant" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="t" for="exampleFormControlInput1">Email</label>
                                    <input type="email" name="email" id="email"  class="form-control form-control-sm" placeholder="Enter Restaurant Email">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="t" for="exampleFormControlInput1">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control form-control-sm" placeholder="Enter Restaurant Phone">
                                </div>
                            </div>

                            <div class="col-6 d-flex">
                                <div class="form-group">
                                    <label class="t">Delivery Time</label>
                                    <div class="col-12 pr-10 pl-0">
                                        <input type="text" name="delivery_time"  id="delivery_time" class="form-control form-control-sm" placeholder="Enter Delivery time">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="t">Delivery Charges</label>
                                    <div class="col-12 pr-2 pl-0">
                                        <input type="text" name="delivery_charges" id="delivery_charges" class="form-control form-control-sm" placeholder="Enter Delivery charges">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" id="latitude" class="form-control form-control-sm" placeholder="Enter Latitude">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" id="longitude" class="form-control form-control-sm" placeholder="Enter Longitude" >
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">About Restaurant</label>
                                    <textarea class="form-control" id="aboutUs" name="aboutUs"></textarea>
                                </div>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="t" for="">Address</label>
                                    <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Enter Restaurant Address">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">

                                    <div class="d-flex">
                                        <div class="col-6 pr-2 pl-0">
                                            <label class="t">Start Time</label>
                                            <input type="time" name="start_time" id="start_time" class="form-control form-control-sm" placeholder="Enter Start Time">
                                        </div>
                                        <div class="col-6 pl-2 pr-0">
                                            <label class="t">Close Time</label>
                                            <input type="time" name="end_time" id="end_time" class="form-control form-control-sm" placeholder="Enter End Time">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">

                            <div class="col-6">
                                <label>Restaurant Logo</label>
                                <div class="custom-file">
                                    <input type="file" style="height: auto;" name="logo" id="customFileEg1" autocomplete="" class="form-control" onchange="editLoadFile(event)">
{{--                                    <input type="file" name="logo" id="customFileEg1" class="custom-file-input" onchange="editLoadFile(event)">--}}
{{--                                    <label class="custom-file-label" for="customFileEg1"></label>--}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <center>
                                        <img class="mt-3 restaurant-logo" style="width: 30%;border: 1px solid; border-radius: 10px;"
                                             id="output1" src="" alt="image"/>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" style="background: #ff982f; border: none;color: #fff;" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary update-restaurant" style="background: #ff982f;border: none;color: #fff;" type="submit">Submit</button>
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
        $(document).ready(function (e) {


            $('#customFileEg1').change(function(){

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#output').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
        /* START - blockUi */
        function blockUi(){
            $.blockUI({
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
            });
        }
        function successMsg(_msg){
            window.toastr.success(_msg);
        }
        function errorMsg(_msg){
            window.toastr.error(_msg);
        }
        function warningMsg(_msg){
            window.toastr.warning(_msg);
        }
        /* END - blockUi */

        /* START - preview image */
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            console.log(output.src);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        var editLoadFile = function(event) {
            var output1 = document.getElementById('output1');
            output1.src = URL.createObjectURL(event.target.files[0]);
            output1.onload = function() {
                URL.revokeObjectURL(output1.src) // free memory
            }
        };
        /* END - preview image */

        /* START - AJAX code add/edit/delete */
        $(document).ready(function(){

            $('.statusSet').change(function() {
                const statusNum = $(this).val();
                console.log(statusNum);
                //var status = $(this).prop('checked') == true ? 'approved' : 'pending';
                var restaurant_id = $(this).attr('data-id');
                // console.log(order_id);

                // blockUi();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'{{route('admin.restaurant.changeStatus')}}',
                    data:{'_token': '{{ csrf_token() }}','status': statusNum, 'restaurant_id': restaurant_id},
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
           $('.add-restaurant').on('submit',function (e){
              e.preventDefault();
              var data = $('.add-restaurant');
               data = new FormData(data[0]);
               blockUi();
               $.ajax({
                   type:'POST',
                   dataType:'json',
                   url:'{{route('admin.restaurant.store')}}',
                   data:data,
                   cache: false,
                   contentType: false,
                   processData: false,
                   success:function(data) {
                       $.unblockUI();
                       if(data.status === 1){
                           successMsg(data.message);
                           $('#addRestaurantModal').modal('hide');
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

            /* START - AJAX code EDIT restaurant */
            $('.edit-restaurant-btn').click(function (e) {
                //--- get object & parse into Javascript object
                var data = JSON.parse($(this).attr('data-id'));

                $('#editRestaurantModal').modal('show');
                // console.log(data);
                // return;

                //--- set values from that object
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#latitude').val(data.latitude);
                $('#longitude').val(data.longitude);
                $('#address').val(data.address);
                $('#start_time').val(data.start_time);
                $('#end_time').val(data.end_time);
                $('#delivery_time').val(data.delivery_time);
                $('#delivery_charges').val(data.delivery_charges);
                $('#aboutUs').val(data.aboutUs);
                $('#password').val(data.password);
                $('#restaurant-id').val(data.id);
                $('.restaurant-logo').attr("src",'{{asset('')}}'+data.logo);
                {{--$('#store_image').html("<img src={{ URL::to('/') }}/images/" + html.data.logo + " width='70' class='img-thumbnail' />");--}}
                {{--$('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.logo+"' />");--}}
                // var image = $('img').attr('src').filename;
                // image = data.logo;
                // console.log(image);
                // return;

                //--- EDIT AJAX Code
                $('.edit-restaurant').submit(function (e) {
                    e.preventDefault();
                    // let data = $(this).serialize();
                    var data = $('.edit-restaurant');
                    data = new FormData(data[0]);

                    /*--- START - Update Record Ajax code */
                    blockUi();
                    $.ajax({
                        type: 'POST',
                        url: '{{route('admin.restaurant.update')}}',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $.unblockUI();
                            if (data.status === 1) {
                                successMsg(data.message);
                                // $('#editRestaurantModal').modal('hide');
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
            $('.delete-restaurant-btn').click(function (e) {
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
                    url:'{{route('admin.restaurant.delete')}}',
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
