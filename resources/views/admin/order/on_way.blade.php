@extends('admin.layouts.app')
@section('title','On Way Orders')
@section('content')
    <!-- START - DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between">
            <div class="row justify-content-between align-items-center">
                <h6 class="ml-3 font-weight-bold">On Way Orders</h6>
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
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 70px;">Order No</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">User</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">Payment Type</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 43px;">Order Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 85px;">Place Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 30px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $res)
                                    <tr class="odd">
                                        <td class="sorting_1">{{$res->id}}</td>
                                        <td>{{ $res->user->name }}</td>
                                        <td>{{ ucfirst($res->payment_type) }}</td>
                                        <td>
                                            @php $statuses = \App\Models\Status::all(); @endphp
                                            <select data-id="{{$res->id}}" class="custom-select custom-select-sm statusSet" aria-label="Select Status">
                                                @foreach($statuses as $status)
                                                <option value="{{$status->status}}" {{ $res->status == $status->status ? "selected" : "" }}>{{ $status->status }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            {{$res->created_at->toFormattedDateString()}}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('admin.order.orderDetails',$res->id)}}" class="btn btn-sm btn-primary detail-order-btn"><i class="fas fa-eye"></i></a>
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
                                    <label class="input-label" for="exampleFormControlInput1">Delivery Charges</label>
                                    <input type="text" name="delivery_charges" value="" id="delivery_charges" class="form-control form-control-sm" disabled>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label">Total Commission</label>
                                    <div>
                                        <input type="text" name="total_commission" id="total_commission" class="form-control form-control-sm" value="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Order Status</label>
                                    <input type="text" name="payment_status" value="" id="payment_status" class="form-control form-control-sm" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                    url:'{{url('/admin/order/change-status')}}',
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
            });

            $('.detail-order-btn').click(function (e) {
                //--- get object & parse into Javascript object
                var data = JSON.parse($(this).attr('data-id'));
                console.log(data);
                var order_status = ($(this).attr('data-order_status'));
                $('#detailModal').modal('show');

                $('#total_commission').val(data.total_commission);
                $('#delivery_charges').val(data.delivery_charges);
                $('#payment_status').val(order_status.toUpperCase());

            });

        });
        /* END - AJAX code add/edit/delete */
    </script>
@endsection
