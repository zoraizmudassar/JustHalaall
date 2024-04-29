@extends('admin.layouts.app')
@section('title','Restaurant Order Weekly Report')
@section('content')

    <!-- START - DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between">
            <div class="row justify-content-between align-items-center">
                <h6 class="ml-3 font-weight-bold">Restaurant Order Weekly Report</h6>
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
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 101px;">Delivery Charges</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 70px;">Tax Percent</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 43px;">Tax</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 63px;">Commission Percent</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 40px;">Total Commission</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 40px;">Sub Total</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 40px;">Total</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 40px;">Quantity</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 40px;">Unit Price</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 40px;">Comission Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 30px;">Payment Method</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 30px;">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sum_tax_percent = 0; ?>
                                <?php $sum_tax = 0; ?>
                                <?php $sum_sub_utotal = 0; ?>
                                <?php $sum_total = 0; ?>
                                <?php $sum_commission_percent = 0; ?>
                                <?php $sum_total_commission = 0; ?>
                                <?php $sum_quantity = 0; ?>
                                <?php $sum_unit_price = 0; ?>
                                @foreach($orders as $res)
                                    <tr class="odd">
                                        <td class="sorting_1">{{$res->order->id}}</td>
                                        <td>{{ $res->delivery_charges }}</td>
                                        <td>{{ $res->tax_percent }}</td>
                                        <td>{{ $res->tax }}</td>
                                        <td>{{ $res->commission_percent }}</td>
                                        <td>{{ $res->total_commission }}</td>
                                        <td>{{ $res->sub_total }}</td>
                                        <td>{{ $res->total }}</td>
                                        <td>{{ $res->quantity }}</td>                                        
                                        <td>{{ $res->unit_price }}</td>
                                        <td>{{ $res->comission_status }}</td>
                                        <td>{{$res->order->payment_type}}</td>
                                        <td>{{$res->created_at->toFormattedDateString()}}</td>
                                    </tr>
                                    <?php $sum_tax_percent += $res->tax_percent; ?>
                                    <?php $sum_tax += $res->tax; ?>
                                    <?php $sum_sub_utotal += $res->sub_total; ?>
                                    <?php $sum_commission_percent += $res->commission_percent; ?>
                                    <?php $sum_total += $res->total; ?>
                                    <?php $sum_total_commission += $res->total_commission; ?>
                                    <?php $sum_quantity += $res->quantity; ?>
                                    <?php $sum_unit_price += $res->unit_price; ?>
                                @endforeach
                                </tbody>
                                <tfoot class="bg-dark">
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{$sum_tax_percent}}</td>
                                        <td>{{$sum_tax}}</td>
                                        <td>{{$sum_commission_percent}}</td>
                                        <td>{{$sum_total_commission}}</td>
                                        <td>{{$sum_sub_utotal}}</td>
                                        <td>{{$sum_total}}</td>
                                        <td>{{$sum_quantity}}</td>
                                        <td>{{$sum_unit_price}}</td>                                        
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tfoot>
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
                                    <label class="input-label">Total Commission</label>
                                    <div>
                                        <input type="text" name="total_commission"  id="total_commission" class="form-control form-control-sm" value="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">Delivery Charges</label>
                                    <input type="text" name="delivery_charges" value="" id="delivery_charges" class="form-control form-control-sm" disabled>
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
                                    <label class="input-label" for="exampleFormControlInput1">Payment ID</label>
                                    <input type="text" name="payment_id" value="" id="payment_id" class="form-control form-control-sm" disabled>
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
                    url:'{{route('admin.order.changeStatus')}}',
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

            $('.orderStatus').change(function() {
                const status = $(this).val();
                var order_id = $(this).attr('data-id');

                //blockUi();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'{{route('admin.order.acceptedStatus')}}',
                    data:{'_token': '{{ csrf_token() }}','status': status, 'order_id': order_id},
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
                            // window.location.reload();
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
                $('#detailModal').modal('show');

                $('#total_price').val(data.order_details.total);
                $('#total_commission').val(data.order_details.total_commission);
                $('#delivery_charges').val(data.order_details.delivery_charges);
                $('#payment_status').val(data.payment_status.toUpperCase());
                $('#payment_id').val(data.charge_id);

            });

        });
        /* END - AJAX code add/edit/delete */
    </script>
@endsection
