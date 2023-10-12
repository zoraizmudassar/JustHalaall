@extends('restaurant.layouts.app')
@section('title','Enable Deals')
@section('content')
    <!-- START - DataTales Example -->


    <div class="card shadow mb-4">
    <div class="card-header py-3 justify-content-between">
        <div class="row justify-content-between align-items-center">
            <h6 class="ml-3 font-weight-bold">{{$status}} Deal's</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-5">
            <div class="wrapper">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dataTable table-hover" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">Deal Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price (£)</th>
                                    <th scope="col">Delivery Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Availablity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($deals as $res)
                                    <tr>
                                        <td style="vertical-align: middle;">{{$res->name}}</td>
                                        <td style="vertical-align: middle;">{{substr($res->description, 0, 20).'...'}}</td>
                                        <td style="vertical-align: middle;">{{$res->price}}</td>
                                        <td style="vertical-align: middle;">{{$res->delivery_time}}</td>
                                        @if($res->status == 1)
                                        <td style="vertical-align: middle;"><span class="badge badge-success p-2">Enable</span></td> 
                                        @elseif($res->status == 0)
                                        <td style="vertical-align: middle;"><span class="badge badge-danger p-2">Disable</span></td> 
                                        @endif
                                        <td style="vertical-align: middle;">
                                            <input data-id="{{$res->id}}" id="check" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" {{ $res->status ? 'checked' : '' }}>
                                        </td>                
                                        <td style="vertical-align: middle;">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" data-id="{{$res}}" class="btn btn-sm btn-warning edit-deal-btn mx-1" style="border-radius: 5px;"><i class="fa fa-pencil-alt"></i></button>
                                                <button type="button" data-id="{{$res->id}}" class="btn btn-sm btn-danger delete-deal-btn mx-1" style="border-radius: 5px;"><i class="fa fa-trash-alt"></i></button>
                                                <a data-id="{{$res->id}}" style="border-radius: 5px;" class="btn btn-sm btn-primary detail-order-btn detail mx-1"><i class="fas fa-eye"></i></a>
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Deal Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="single-product-img" id="ModelimageBox">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="single-product-content">                       
                            <h3 id="Modelname"></h3>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-0" id="Modelprice"></p>		
                                </div>
                                <div class="col-6">
                                    <span class="badge badge-warning p-2 mr-4" style="float: right; text-transform: capitalize;" id="Modelstatus"></span>                                        
                                </div>
                            </div>
                            <p id="Modeldescription" class="mt-2"></p>
                            <div class="single-product-form">					
                                <p class="mb-0" id="Modelcategory"></p>
                            </div>
                            <p class="mt-1 mb-1" id="Modelis_available"></p>
                            <p class="mt-1 mb-1" id="Modelis_featured"></p>
                            <p id="Modeldelivery_time"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Deal</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form  class="edit-deal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Name</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Description</label>
                                <input type="text" name="description" id="description" class="form-control form-control-sm" placeholder="Description">
                                <input type="hidden" name="product_id" id="product_id">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Price</label>  <small class="text-danger">(£)</small>
                                <input type="text" name="price" id="price" class="form-control form-control-sm" placeholder="Price">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sel1">Select Category</label>
                                <select  name="category_id"  id="category_id" class="form-control" id="sel1">
                                    @php $categories = \App\Models\Category::all(); @endphp
                                    <option selected="selected"  disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id ? $category->id : ''}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" style="height: auto" name="image" id="customFileEg1" class="form-control" onchange="loadFile(event)">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Delivery Time</label><small class="text-danger">(In Minute's)</small>
                                <input type="text" name="delivery_time" id="delivery_time" class="form-control form-control-sm" placeholder="Delivery Time">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <center>
                                    <img class="mt-3 product-logo" style="width: 30%;border: 1px solid; border-radius: 10px;"
                                            id="output" src="" alt="image"/>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success update-restaurant" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5 align="center" style="margin:0;">Are you sure you want to remove this data?</h5>
            </div>
            <div class="modal-footer">
                <button type="button"  id="ok_button"  class="btn btn-danger ok_button">OK</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var loadFile = function(event){
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    /* START - AJAX code add/edit/delete */
    $(document).ready(function(){
        $(".detail").click(function(){
            var id = $(this).attr("data-id");
            deleteuser(id);
        });
        function deleteuser(id){
            $.ajax({
                type: 'POST',
                url:'{{url('/restaurant/deal/deal-detail')}}',
                data:{'_token': '{{ csrf_token() }}','id': id},
                dataType: "json",
                success: function(data){
                    if(data.status == 1){
                        var baseUrl = window.location.origin;
                        $("#Modelname").html(data.data.name);
                        $("#Modelprice").html('<b>£</b> '+data.data.price);
                        $("#Modeldescription").html(data.data.description);      
                        $("#Modelrestaurant_id").html(data.data.restaurant_id);
                        $("#Modelstatus").html(data.data.status);
                        $("#Modelcategory").html('<b>Category:</b> '+data.data.category_id);                                                 
                        $("#Modelis_available").html('<b>Available: </b><i class="fa fa-check-circle text-info-300" style="color:#3dbf3d"></i>');                            
                        $("#Modeldelivery_time").html(' <b> Delivery Time: </b> '+data.data.delivery_time+' minutes <i class="fas fa-clock text-info-300"></i>');     
                        $("#ModelimageBox").html("<img class='product-img embed-responsive' src=\"" + baseUrl+'/'+data.data.image + "\">");
                        $('#exampleModalCenter').modal('show');
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                        });
                    }
                }
            });
        }
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? "1" : "0";
            var deal_id = $(this).data('id');

            // blockUi();
            $.ajax({
                type:'POST',
                dataType:'json',
                url:'{{route('restaurants.deal.changeStatus')}}',
                data:{'_token': '{{ csrf_token() }}','status': status, 'deal_id': deal_id},
                success:function(data) {
                    // $.unblockUI();
                    if(data.status === 1){
                        Swal.fire({
                            icon: 'success',
                            title: data.message,
                        });
                        window.location.reload();
                    }
                    if(data.status === 0){
                        Swal.fire({
                            icon: 'error',
                            title: data.message,
                        });
                    }
                },
                error:function(data) {
                    console.log('error');
                    // $.unblockUI();
                }
            });
        });

        /* START - AJAX code EDIT restaurant */
        $('.edit-deal-btn').click(function (e) {
            var data = JSON.parse($(this).attr('data-id'));
            $('#editProductModal').modal('show');
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#price').val(data.price);
            $('#category_id').val(data.category_id);
            $('#product_id').val(data.id);
            $('#delivery_time').val(data.delivery_time);
            $('.product-logo').attr("src",'{{asset('')}}'+data.image);

            //--- EDIT AJAX Code
            $('.edit-deal').submit(function (e) {
                e.preventDefault();
                var data = $('.edit-deal');
                data = new FormData(data[0]);

                /*--- START - Update Record Ajax code */
                blockUi();
                $.ajax({
                    type: 'POST',
                    url: '{{route('restaurants.deal.update')}}',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data){
                        $.unblockUI();
                        if(data.status === 200){
                            Swal.fire({
                                icon: 'success',
                                title: data.message,
                            });
                            $('#editProductModal').modal('hide');
                            window.location.reload();
                        }
                        if(data.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: data.message,
                            });
                        }
                    },
                    error: function (data) {
                        console.log('error');
                        $.unblockUI();
                    }
                });
            });
        });

        var data_id;
        $('.delete-deal-btn').click(function (e) {
            data_id = JSON.parse($(this).attr('data-id'));
            $('#confirmModal').modal('show');
        });
        //--- DELETE AJAX Code
        $('#ok_button').click(function(){
            var data = { "_token": "{{@csrf_token()}}", "data_id": data_id };
            blockUi();
            $.ajax({
                type:'POST',
                url:'{{route('restaurants.deal.delete')}}',
                data:data,
                success:function (data){
                    $.unblockUI();
                    if(data.status === 1){
                        Swal.fire({
                            icon: 'success',
                            title: data.message,
                        });
                        $('#confirmModal').modal('hide');
                        window.location.reload();
                    }
                    if(data.status === 0){
                        Swal.fire({
                            icon: 'error',
                            title: data.message,
                        });
                    }
                },
                error:function (data){
                    console.log('error');
                    $.unblockUI();
                }
            });
        });
    });

    var editLoadFile = function(event) {
        var output1 = document.getElementById('output1');
        output1.src = URL.createObjectURL(event.target.files[0]);
        output1.onload = function() {
            URL.revokeObjectURL(output1.src) // free memory
        }
    };
</script>
@endsection
