@extends('admin.layouts.app')
@section('title','Users')
@section('content')
@section('style')

@endsection
<!-- START - DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 justify-content-between">
        <div class="row justify-content-between align-items-center">
            <h6 class="ml-3 font-weight-bold">Users</h6>
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
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 120px;">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 170px;">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100px;">Phone</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 60px;">Address</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 130px;">Status</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 120px;">Image</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 85px;">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr class="odd">
                                    <td class="sorting_1">{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>

                                        <input data-id="{{$user->id}}" id="check" class="toggle-class" type="checkbox" data-onstyle="warning" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->is_verified ? 'checked' : '' }}>

                                    </td>
                                    <td><img src="{{!empty($user->avatar) ? asset($user->avatar) : ""}}" class="embed-responsive"></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" style="    background: #ff982f;
    border: none;" data-id="{{$user}}" class="btn btn-sm btn-success edit-user-btn"><i class="fa fa-pencil-alt"></i></button>
                                            <button type="button" data-id="{{$user->id}}" class="btn btn-sm btn-danger delete-user-btn"><i class="fa fa-trash-alt"></i></button>
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
<div class="modal fade bd-example-modal-lg" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form  class="add-user" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Name</label>
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Username">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="example@example.com">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-sm" placeholder="+000-000-000">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="">Address</label>
                                <input type="text" name="address" class="form-control form-control-sm" placeholder="Enter Address">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="custom-file">
                                    <input type="file" name="avatar" id="customFileEg1" class="form-control" onchange="loadFile(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <center>
                                    <img class="mt-3" style="width: 30%;border: 1px solid; border-radius: 10px;"
                                         id="output" src="" alt="image"/>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" style="background: #ff982f;border: none" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" style="background: #ff982f;border: none" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END - Add Restaurant Modal -->

<!-- START - Edit User Modal -->
<div class="modal fade bd-example-modal-lg" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form  class="edit-user" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Name</label>
                                <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="New User" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="EX : example@example.com">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Phone</label>
                                <input type="text" name="phone" id="val"  class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="">Address</label>
                                <input type="text" name="address" id="address"  class="form-control form-control-sm" placeholder="Ex : Lahore Pakistan">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-6">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" style="height: auto;" autocomplete="" id="customFileEg1" class="form-control" onchange="editLoadFile(event)">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <input type="hidden" name="id" value="" id="user-id">
                        <div class="col-12">
                            <div class="form-group">
                                <center>
                                    <img class="mt-3 user-logo" style="width: 30%;border: 1px solid; border-radius: 10px;"
                                         id="output1" src="" alt="image"/>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" style="background: #ff982f;border: none" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary update-restaurant" style="background: #ff982f;border: none"type="submit">Submit</button>
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

            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');
                $('.status-form').submit;

                // blockUi();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'{{url('/admin/users/change-status')}}',
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

            /* START - AJAX code EDIT restaurant */
            $('.edit-user-btn').click(function (e) {
                //--- get object & parse into Javascript object
                var data = JSON.parse($(this).attr('data-id'));

                $('#editUserModal').modal('show');

                //--- set values from that object
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#val').val(data.phone);
                $('#address').val(data.address);
                $('#user-id').val(data.id);

                $('.user-logo').attr("src",'{{asset('')}}'+data.avatar);
                //console.log($('.user-logo').attr("src",'{{asset('')}}'+data.avatar));

                //--- EDIT AJAX Code
                $('.edit-user').submit(function (e) {
                    e.preventDefault();
                    var data = $('.edit-user');
                    data = new FormData(data[0]);

                    /*--- START - Update Record Ajax code */
                    //blockUi();
                    $.ajax({
                        type: 'POST',
                        url: '{{route('admin.user.update')}}',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $.unblockUI();
                            if (data.status === 200) {
                                successMsg(data.message);
                                $('#editUserModal').modal('hide');
                                window.location.reload();
                            }
                            if (data.status === 404) {
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
            $('.delete-user-btn').click(function (e) {
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
                    url:'{{route('admin.user.delete')}}',
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
