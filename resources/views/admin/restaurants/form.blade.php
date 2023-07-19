@extends('admin.layouts.app')
@section('title','Add New Restaurant')
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
                    <h6 class="m-0 font-weight-bold">Add New Restaurant</h6>
                </div>
                <div class="card-body">
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
                                        <label>Phone</label><small class="text-danger">(Only Digit's)</small>
                                        <input type="text" name="phone" maxlength="10" class="form-control form-control-sm onlynumber" placeholder="Enter Restaurant Phone">
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
                                        <label>Delivery Time</label><small class="text-danger">(In Minute's)</small>
                                        <div class="col-12 pr-10 pl-0">
                                            <input type="text" name="delivery_time" class="form-control form-control-sm onlynumber" placeholder="Enter Delivery time">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Delivery Charges</label><small class="text-info">(£)</small>
                                        <div class="col-12 pr-2 pl-0">
                                            <input type="text" name="delivery_charges" class="form-control form-control-sm onlynumber" placeholder="Enter Delivery charges">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input type="text" name="latitude" class="form-control form-control-sm" placeholder="Enter Latitude">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input type="text" name="longitude" class="form-control form-control-sm" placeholder="Enter Longitude" >
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
                                        <input type="file" name="logo" id="customFileEg1" class="form-control" onchange="editLoadFile(event)">
                                        {{--                                    <label class="custom-file-label" for="customFileEg1"></label>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <center>
                                            <img class="mt-3" style="width: 30%;border: 1px solid; border-radius: 10px;"
                                                 id="output1" src="{{ asset('assets/admin/img/noImageSelected.jpg') }}" alt="image"/>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" style="background: #ff982f;border: none;color: #fff;" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
<script>
    //    Script for Preview Image
    var editLoadFile = function(event) {
        var output1 = document.getElementById('output1');
        output1.src = URL.createObjectURL(event.target.files[0]);
        output1.onload = function() {
            URL.revokeObjectURL(output1.src) // free memory
        }
    };
    //    End Preview Image Code
    $(document).ready(function (){

        $(".onlynumber").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                // $(".errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
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
                        // $('#addRestaurantModal').modal('hide');
                        // $('#addRestaurantModal').modal('toggle');
                        window.location.href = data.url;
                        // window.location.reload();
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

    });

</script>
@endsection
