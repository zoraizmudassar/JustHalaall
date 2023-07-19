
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title','Just Halaall Admin')</title>

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset("assets/web/images/index.jpg") }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset("assets/web/images/index.jpg") }}">
{{--include css blade file--}}
    @include('admin.layouts.css')
    <style>
        .custom-file-label-sm::after{
            height: calc(1.1em + .75rem);
            line-height: 1.25;
        }
        .custom-file-label-sm{
            height: calc(1.1em + .75rem + 2px);
        }
    </style>
    @yield('style')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

  @include('admin.layouts.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
           @include('admin.layouts.navbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

           @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
       @include('admin.layouts.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


{{--include Js file--}}
@include('admin.layouts.js')

</body>

</html>
