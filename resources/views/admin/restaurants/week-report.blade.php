@extends('admin.layouts.app')
@section('title','Weekly Restaurants Report')
@section('content')

    <!-- START - DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between">
            <div class="row justify-content-between align-items-center">
                <h6 class="ml-3 font-weight-bold">Weekly Restaurants Report</h6>
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
                                            <button data-id="{{$res->id}}" type="button" style="background: #ff982f; border: none" class="btn btn-sm handleButtonClick"><i class="fa fa-eye"></i></button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Weekly Restaurant Order</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form  class="edit-restaurant" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="modalbody">
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" style="background: #ff982f; border: none;color: #fff;" type="button" data-dismiss="modal">Cancel</button>
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
        $('.handleButtonClick').click(function (e) {
                //--- get object & parse into Javascript object
                var data1 = JSON.parse($(this).attr('data-id'));
        console.log('Value of data-id attribute:', data1);
        var data = {
            "_token": "{{ csrf_token() }}",
            "dataId": data1
        };
        $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'{{route('admin.report.changeStatus')}}',
                    data:{'_token': '{{ csrf_token() }}', 'restaurant_id': data1},

                    success:function(data) {
                        // $.unblockUI();
                        if(data.status === 200){
                            console.log('data ->>>>>>>>>>', data);
                            $('#modalbody').empty();
                            data.data.forEach(function(week, index) {
    console.log('week', week, index);
    // Append HTML content for each week to the modal body
    var htmlContent = `
        <div class="row mb-0">
            <div class="col-4 mb-0">
                <div class="form-group mb-0">
                    <label class="t mb-0" for="exampleFormControlInput1"><b>Weak ${index + 1}</b></label>
                    <h6 class="mb-0">Start Date : "${week['Start Date']}"</h6>
                    <input type="hidden" class="start-date" value="${week['Start Date']}">
                    <input type="hidden" class="res-id" value="${data1}">
                </div>
            </div>
            <div class="col-4 mb-0">
                <div class="form-group mb-0">
                    <label class="t mb-0" for="exampleFormControlInput1"><b>&nbsp;</b></label>
                    <h6 class="mb-0">End Date : "${week['End Date']}"</h6>
                    <input type="hidden" class="end-date" value="${week['End Date']}">
                </div>
            </div>
            <div class="col-4 mb-0">
                <label class="t mb-0" for="exampleFormControlInput1"><b>&nbsp;</b></label>
                <a class="btn btn-secondary my-4 btn-sm show-orders" style="background: #ff982f; border: none;color: #fff;">Show Orders</a>
            </div>
        </div>
    `;
    
    $('#modalbody').append(htmlContent);
});

                            $('#editRestaurantModal').modal('show');
                        }
                        if(data.status === 404){
                            errorMsg(data.message);
                        }
                    },
                    error:function(data) {
                        console.log('error');
                    }
                });
    });

// Event delegation for handling click event on dynamically added elements with class 'show-orders'
$(document).on('click', '.show-orders', function() {
    console.log('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
    // Retrieve start date and end date values from hidden input fields
    var startDate = $(this).closest('.row').find('.start-date').val();
    var endDate = $(this).closest('.row').find('.end-date').val();
    var restID = $(this).closest('.row').find('.res-id').val();    
    
    // Print start date and end date values to the console
    console.log('Start Date:', startDate);
    console.log('End Date:', endDate);
    console.log('restID:', restID);

    window.location.href = '/admin/reports/weekly-detail/'+startDate+'/'+endDate+'/'+restID;
    
    // Implement your logic to show orders based on start date and end date
});





    
</script>
@endsection
