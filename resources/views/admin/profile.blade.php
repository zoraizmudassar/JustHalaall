@extends('admin.layouts.app')
@section('title','Admin Profile')
@section('content')

    <div class="card mb-3">
        <div class="card-header">
            <p><i class="fa fa-check-square-o"></i>Update Admin Profile</p>
        </div>

        <div class="card-body">
            <form class="update-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{$admin->first_name}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{$admin->email}}" disabled="">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>New Password</label>
                        <div class="d-flex position-relative justify-content-end">
                            <input type="password" name="password" id="password" class="form-control" value="" placeholder="New Password">
                            <i class="fa fa-eye position-absolute" id="password-eye" style="margin: 11px;"></i>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="d-flex position-relative justify-content-end">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="" placeholder="Confirm Password">
                            <i class="fa fa-eye position-absolute" id="password-eye2" style="margin: 11px;"></i>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Profile Image</label>
                            <input type="file" style="height: auto" name="image" id="customFileEg1" class="form-control" onchange="loadFile(event)">

                        </div>
                    </div>

                    <div class="col-md-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <center>
                                <img class="mt-3" style="width: 15%;border: 1px solid; border-radius: 10px;"
                                     id="output" src="{{asset($admin->avatar)}}" alt="image"/>
                            </center>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary create-user" style="background: #ff982f;border: none;float: right" type="submit">Update</button>


            </form>


        </div>
    </div>
@endsection
@section('script')
    <script>

        /* START - preview image */
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $('#password-eye').hover(function () {
            $('#password').attr('type', 'text');
        }, function () {
            $('#password').attr('type', 'password');
        });

        $('#password-eye2').hover(function () {
            $('#password_confirmation').attr('type', 'text');
        }, function () {
            $('#password_confirmation').attr('type', 'password');
        });

        $(".update-form").submit(function(e){
            e.preventDefault();
            // let data = $(this).serialize();
            let data = $('.update-form');
            data = new FormData(data[0]);
            var pass = $('#password').val();
            if(pass){
                if(pass.length < 8){
                    // error
                    return alert('Password should be at least 8 character');
                }
            }
            //blockUi();
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.updateProfile') }}',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(data) {
                    //$.unblockUI();
                    if(data.status == 1){
                        successMsg(data.message);
                        window.location.reload();
                    }
                    if(data.status == 0){
                        errorMsg(data.message);
                    }
                },
                error:function(data) {
                    console.log('error');
                    // $.unblockUI();
                }
            });
        });
    </script>



@endsection
