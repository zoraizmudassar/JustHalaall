<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('restaurants.home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink" style="display: none;"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Just Halaall <sup>Restaurant</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('restaurants.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseproduct" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-list"></i>
            <span>Products</span>
        </a>
        <div id="collapseproduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Product Components:</h6>
                <a class="collapse-item" href="{{route('restaurants.product.create')}}">Add New</a>
                <a class="collapse-item" href="{{route('restaurants.product.approved')}}">Approved</a>
                <a class="collapse-item" href="{{route('restaurants.product.pending')}}">Pending</a>
                <a class="collapse-item" href="{{ route('restaurants.product.rejected') }}">Rejected</a>
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
                                <h6 class="collapse-header">Deal Components:</h6>
                <a class="collapse-item" href="{{route('restaurants.deal.create')}}">Add New</a>
                <a class="collapse-item" href="{{route('restaurants.deal.approved')}}">Approved</a>
                <a class="collapse-item" href="{{route('restaurants.deal.pending')}}">Pending</a>
                <a class="collapse-item" href="{{route('restaurants.deal.rejected')}}">Rejected</a>
                <a class="collapse-item" href="{{route('restaurants.deal.enable')}}">Enable</a>
                <a class="collapse-item" href="{{route('restaurants.deal.disable')}}">Disable</a>
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
                <a class="collapse-item" href="{{route('restaurants.order.pending-order')}}">Pending</a>
                <a class="collapse-item" href="{{route('restaurants.order.accepted-order')}}">Accepted</a>
                <a class="collapse-item" href="{{route('restaurants.order.on-way')}}">On Way</a>
                <a class="collapse-item" href="{{route('restaurants.order.complete-order')}}">Complete</a>
                <a class="collapse-item" href="{{route('restaurants.order.rejected-order')}}">Rejected</a>
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
