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
                    <h6 class="m-0 font-weight-bold">Add New Category</h6>
                </div>
                <div class="card-body">
                    <form class="add-category" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">Name</label>
                                        <input type="text" name="name" class="form-control form-control-sm"
                                               placeholder="Enter Category Name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">Type</label>
                                        <input type="text" name="type" class="form-control form-control-sm"
                                               placeholder="Enter Category Type">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">

                                <div class="col-6">
                                    <label>Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="customFileEg1" class="form-control"
                                               onchange="loadFile(event)">
                                        {{--                                    <label class="custom-file-label" for="customFileEg1"></label>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <center>
                                            <img class="mt-3 category-logo"
                                                 style="width: 30%;border: 1px solid; border-radius: 10px;"
                                                 id="output" src="{{ asset('assets/admin/img/noImageSelected.jpg') }}"
                                                 alt="image"/>
                                        </center>
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
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        $(document).ready(function () {
            /* START - AJAX code ADD restaurant */
            $('.add-category').on('submit', function (e) {
                e.preventDefault();
                var data = $('.add-category');
                data = new FormData(data[0]);
                //blockUi();
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '{{route('admin.category.store')}}',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $.unblockUI();
                        if (data.status === 1) {
                            successMsg(data.message);
                            $('#addCategoryModal').modal('hide');
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
