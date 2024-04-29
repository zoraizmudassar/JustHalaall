<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink" style="display: none;"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Just Halaall <sup>Admin</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
{{--    <div class="sidebar-heading">Restaurant</div>--}}
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-utensils"></i>
            <span>Restaurants</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Restaurant Components:</h6>
                <a class="collapse-item" href="{{route('admin.restaurant.form')}}">Add New</a>
                <a class="collapse-item" href="{{ route('admin.restaurant.approved') }}">Approved</a>
                <a class="collapse-item" href="{{ route('admin.restaurant.pending') }}">Pending</a>
                <a class="collapse-item" href="{{ route('admin.restaurant.rejected') }}">Rejected</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecategory" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-list-alt"></i>
            <span>Categories</span>
        </a>
        <div id="collapsecategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category Components:</h6>
                <a class="collapse-item" href="{{route('admin.category.create')}}">Add New</a>
                <a class="collapse-item" href="{{route('admin.category.index')}}">List</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsedeals" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-gift"></i>
            <span>Deal's</span>
        </a>
        <div id="collapsedeals" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Deals Components:</h6>
                <a class="collapse-item" href="{{route('admin.deal.approved')}}">Approved</a>
                <a class="collapse-item" href="{{route('admin.deal.pending')}}">Pending</a>
                <a class="collapse-item" href="{{route('admin.deal.rejected')}}">Rejected</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseproduct" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-list"></i>
            <span>Products</span>
        </a>
        <div id="collapseproduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Product Components:</h6>
                <a class="collapse-item" href="{{route('admin.product.approved')}}">Approved</a>
                <a class="collapse-item" href="{{ route('admin.product.pending') }}">Pending</a>
                <a class="collapse-item" href="{{ route('admin.product.rejected') }}">Rejected</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseorder" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-shipping-fast"></i>
            <span>Order's</span>
        </a>
        <div id="collapseorder" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Order Components:</h6>
                <a class="collapse-item" href="{{route('admin.order.pending')}}">Pending</a>
                <a class="collapse-item" href="{{route('admin.order.accepted')}}">Accepted</a>
                <a class="collapse-item" href="{{route('admin.order.on-way')}}">On Way</a>
                <a class="collapse-item" href="{{route('admin.order.complete')}}">Complete</a>
                <a class="collapse-item" href="{{route('admin.order.rejected')}}">Rejected</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsereport" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-file-alt"></i>
            <span> Reports</span>
        </a>
        <div id="collapsereport" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Report Components:</h6>
                <a class="collapse-item" href="{{route('admin.report.restaurant')}}">Restaurant</a>
                <a class="collapse-item" href="{{route('admin.report.week')}}">Weekly Report</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
{{--    <hr class="sidebar-divider d-none d-md-block">--}}

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
{{--    <div class="sidebar-heading">Restaurant</div>--}}
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
            <i class="fa fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users Components:</h6>
                <a class="collapse-item" href="{{ route('admin.user.form') }}">Add New</a>
                <a class="collapse-item" href="{{ route('admin.user.active') }}">Active</a>
                <a class="collapse-item" href="{{ route('admin.user.inActive') }}">In Active</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="true" aria-controls="collapsePayment">
            <i class="fa fa-credit-card"></i>
            <span>Payment</span>
        </a>
        <div id="collapsePayment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Payments:</h6>
                <a class="collapse-item" href="{{url('admin/payment')}}">Commission</a>
                <a class="collapse-item" href="{{url('admin/payment/restaurant')}}">Restaurant Payment</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContact" aria-expanded="true" aria-controls="collapseContact">
            <i class="fa fa-envelope"></i>
            <span>Contact us</span>
        </a>
        <div id="collapseContact" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Contact Us:</h6>
                <a class="collapse-item" href="{{ url('admin/contact') }}">All</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTerm" aria-expanded="true" aria-controls="collapseTerm">
            <i class="fa fa-credit-card"></i>
            <span>Term & Cnndition</span>
        </a>
        <div id="collapseTerm" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Term & Conditions</h6>
                <a class="collapse-item" href="{{ url('admin/term/create') }}">Add New</a>
                <a class="collapse-item" href="{{ url('admin/term') }}">All</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePrivacy" aria-expanded="true" aria-controls="collapsePrivacy">
            <i class="fa fa-credit-card"></i>
            <span>Privacies</span>
        </a>
        <div id="collapsePrivacy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Privacies</h6>
                <a class="collapse-item" href="{{ url('admin/privacy/create') }}">Add New</a>
                <a class="collapse-item" href="{{ url('admin/privacy') }}">All</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
