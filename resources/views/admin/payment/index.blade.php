@extends('admin.layouts.app')
@section('title', 'Pending Orders')
@section('content')
    <!-- START - DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between">
            <div class="row justify-content-between align-items-center">
                <h6 class="ml-3 font-weight-bold">Restaurant Commissions</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" role="grid"
                                aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending" style="width: 70px;">Sr.
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 101px;">Restaurant</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 101px;">Pending Commission</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Salary: activate to sort column ascending"
                                            style="width: 30px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($restaurant as $index => $item)
                                        <tr class="odd">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name ?? '' }}</td>
                                            @php
                                                $comission = $payment->where('restaurant_id', $item->id)->where('comission_status', 'pending')->sum('total_commission');
                                            @endphp
                                            <td>{{  $comission?? '0' }}
                                            </td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-sm btn-primary detail-order-btn"
                                                        data-toggle="modal" data-target="#paymentModal{{$item->id}}"><i
                                                            class="fas fa-eye"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- END - DataTales Example -->
                                        <div class="modal fade bd-example-modal-lg" id="paymentModal{{$item->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Payment Detail</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.payment.pay')}}" method="post" class="detail-form" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="restaurant_id" value="{{$item->id??''}}">
                                                                        <label class="input-label"
                                                                            for="exampleFormControlInput1">Restaurant:</label>
                                                                        <b>{{$item->name??''}}</b>
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label class="input-label">Pending Commission:</label>
                                                                        <b>{{$comission??''}}</b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Pay Now</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        /* START - AJAX code add/edit/delete */
        $(document).ready(function() {

            $('.statusSet').change(function() {
                const statusNum = $(this).val();
                var order_id = $(this).attr('data-id');

                //blockUi();
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '{{ url('/admin/order/change-status') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'status': statusNum,
                        'order_id': order_id
                    },
                    // cache: false,
                    // contentType: false,
                    // processData: false,
                    success: function(data) {
                        // $.unblockUI();
                        if (data.status === 200) {
                            successMsg(data.message);
                            // $('#addUserModal').modal('hide');
                            // $('#addRestaurantModal').modal('toggle');
                            // window.location.href = data.url;
                            window.location.reload();
                        }
                        if (data.status === 404) {
                            errorMsg(data.message);
                        }
                    },
                    error: function(data) {
                        console.log('error');
                        // $.unblockUI();
                    }
                });
            });

            $('.detail-order-btn').click(function(e) {
                //--- get object & parse into Javascript object
                var data = JSON.parse($(this).attr('data-id'));
                var order_status = ($(this).attr('data-order_status'));
                console.log(data);

                $('#detailModal').modal('show');

                $('#total_commission').val(data.total_commission);
                $('#delivery_charges').val(data.delivery_charges);
                $('#payment_status').val(order_status.toUpperCase());

            });

        });
        /* END - AJAX code add/edit/delete */
    </script>
@endsection
