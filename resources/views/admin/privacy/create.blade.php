@extends('admin.layouts.app')
@section('title','Create Category')
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
                    <h6 class="m-0 font-weight-bold">Add Privacy</h6>
                </div>
                <div class="card-body">
                    <form class="add-privacy" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">Heading</label>
                                        <input type="text" name="heading" value="{{old('heading')}}" class="form-control form-control-sm"
                                               placeholder="Enter Heading">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">Description</label>
                                        <textarea type="text" name="description" class="form-control form-control-sm">{{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" style="background: #ff982f;border: none;color: #fff;"  type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        /*IMAGE*/
        // var loadFile = function (event) {
        //     var output = document.getElementById('output');
        //     output.src = URL.createObjectURL(event.target.files[0]);
        //     output.onload = function () {
        //         URL.revokeObjectURL(output.src) // free memory
        //     }
        // };

        $(document).ready(function () {
            /* START - AJAX code ADD restaurant */
            $('.add-privacy').on('submit', function (e) {
                e.preventDefault();
                var data = $('.add-privacy');
                data = new FormData(data[0]);
                //blockUi();
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '{{route('admin.privacy.store')}}',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $.unblockUI();
                        if (data.status === 1) {
                            successMsg(data.message);
                            $('#addprivacyModal').modal('hide');
                            // $('#addRestaurantModal').modal('toggle');
                            window.location.href = data.url;
                            //window.location.reload();
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
            });
        });
        /* END - AJAX code ADD restaurant */
    </script>
@endsection
