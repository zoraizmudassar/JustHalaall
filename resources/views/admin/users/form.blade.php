@extends('admin.layouts.app')
@section('title','Admin - Users')
@section('content')
    <style>
        .form-control{
            height: auto;
        }
    </style>
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Add New User</h6>
                </div>
                <div class="card-body">
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

                                        <label class="input-label" for="exampleFormControlInput1">Phone</label><small class="text-danger"> (Only Digit's)</small>
                                        <input type="text" name="phone" id="phone" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" placeholder="+000-000-000">

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
                                                 id="output" src="{{ asset('assets/admin/img/noImageSelected.jpg') }}" alt="image"/>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" style="background: #ff982f;border: none" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>


        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }


        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        /* START - AJAX code ADD restaurant */
        $('.add-user').on('submit',function (e){
            e.preventDefault();
            var data = $('.add-user');
            data = new FormData(data[0]);
            blockUi();
            $.ajax({
                type:'POST',
                dataType:'json',
                url:'{{route('admin.user.store')}}',
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(data) {
                    $.unblockUI();
                    if(data.status === 200){
                        successMsg(data.message);
                        // $('#addUserModal').modal('hide');
                        // $('#addRestaurantModal').modal('toggle');
                        window.location.href = data.url;
                        // window.location.reload();
                    }
                    if(data.status === 404){
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
    </script>
@endsection
