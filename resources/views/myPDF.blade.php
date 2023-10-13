<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
      <div class="row">
            <div class="col-md-6">
              <a href="/homev1">
								<img src="website/assets/img/halaall.png" alt="" style="max-width: 20%;">
							</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <address>
                    <strong>Customer Info:</strong><br>
                    <p class="mb-0">{{$name}}</p>
                    <p class="mb-0">{{$address}}</p>
                    <p class="mb-0">{{$phone}}</p>
                    <p class="mb-0">{{$email}}</p>
                </address>
            </div>
            <div class="col-md-6 text-right">
                <address>
                    <strong>Order {{$order_no}}</strong><br>
                    Date: {{$order_place_date}}<br>
                </address>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Item</th>
                            <th>Amount</th>
                            <th>Order Status</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order_no}}</td>
                            <td>{{$item}}</td>
                            <td>{{$total}}</td>
                            <td>£ {{$total}}</td>
                            <td>{{$address}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <p class="text-right">
                    <strong>Total Amount: £ {{$total}}</strong>
                </p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
