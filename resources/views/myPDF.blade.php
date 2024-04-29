<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid" style="margin-left: -4%;">
      <div class="row">
            <div class="col-md-6">
              <a href="/homev1">
                <img src="website/assets/img/halaall.png" alt="" style="max-width: 15%;">
            </a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 text-right">
                <address>
                   <p class="mb-0"> <strong style="font-size: 13px;">Invoice No. </strong><span style="font-size: 13px;">{{$order_no}}</span></p>
                   <p class="my-0"><span style="font-size: 13px;">{{$order_place_date}}</span> </p>
                </address>
            </div>
            <div class="col-md-6">
                <address>
                    <strong style="font-size: 15px;">BILLED TO</strong><br>
                    <p style="font-size: 13px;" class="mb-0">{{$name}}</p>
                    <p style="font-size: 13px;" class="mb-0">{{$phone}}</p>
                    <p style="font-size: 13px;" class="mb-0">{{$address}}</p>
                </address>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table text-center" style="font-size: 12px;">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Order Id</th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Restaurant</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #737373;">
                            <td>{{$order_no}}</td>
                            <td>{{$item}}</td>
                            <td>2</td>
                            <td>{{$restaurant_name}}</td>     
                            <td>£ {{$total}}</td>
                            <td style="text-transform: capitalize;">{{$status}}</td>
                            <td>{{$address}}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #737373;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                            
                            <td></td>
                            <td>Sub Total</td>
                            <td>£ {{$total}}</td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td></td>
                            <td></td>
                            <td></td>                            
                            <td></td>                            
                            <td></td>
                            <td style="border-bottom: 1px solid #737373;"><strong> Total</strong></td>
                            <td style="border-bottom: 1px solid #737373;">£ {{$total}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4" style="position: fixed; bottom: 20px;">
            <div class="col-md-12">
                <p style="font-size: 25px;">
                    <strong>THANKYOU FOR YOUR ORDER</strong>
                </p>
            </div>
            <div class="col-md-6">
                <address>
                    <strong style="font-size: 15px;">PAYMENT INFORMATION</strong><br>
                    <p style="font-size: 13px;" class="mb-0">{{$name}}</p>
                    <p style="font-size: 13px;" class="mb-0">{{$phone}}</p>
                    <p style="font-size: 13px;" class="mb-0">{{$address}}</p>
                </address>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
