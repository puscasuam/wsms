<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('welcome')}}">
        <div class="sidebar-brand-text mx-3"> Jewelry WMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
           aria-expanded="true" aria-controls="collapseProducts">
            <i class="fas fa-fw fa-folder"></i>
            <span>Products</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('isAuthorized', \App\Product::class)
                    <a class="collapse-item" href="{{ route('newProduct')}}">New product</a>
                @endcan
                <a class="collapse-item" href="{{ route('productsAll')}}">Show products</a>
            </div>
        </div>


        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePartners"
           aria-expanded="true" aria-controls="collapsePartners">
            <i class="fas fa-fw fa-folder"></i>
            <span>Partners</span>
        </a>
        <div id="collapsePartners" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('isAuthorized', \App\Partner::class)
                    <a class="collapse-item" href="{{ route('partnerAdd')}}">New partner</a>
                @endcan
                <a class="collapse-item" href="{{ route('partnersAll')}}">Show partners</a>
            </div>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true"
           aria-controls="collapseOrders">
            <i class="fas fa-fw fa-folder"></i>
            <span>Orders</span>
        </a>
        <div id="collapseOrders" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('orderNew')}}">New order</a>
                <a class="collapse-item" href="{{ route('ordersAll')}}">Show orders</a>
            </div>
        </div>

        @can('isAuthorized', \App\Transaction::class)
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransactions"
               aria-expanded="true" aria-controls="collapseTransactions">
                <i class="fas fa-fw fa-folder"></i>
                <span>Transactions</span>
            </a>

            <div id="collapseTransactions" class="collapse" aria-labelledby="headingPages"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('transactionsAll')}}">Show transactions</a>
                </div>
            </div>
        @endcan

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee"
           aria-expanded="true" aria-controls="collapseEmployee">
            <i class="fas fa-fw fa-folder"></i>
            <span>Employees</span>
        </a>
        <div id="collapseEmployee" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('isAuthorized', \App\Employee::class)
                    <a class="collapse-item" href="{{ route('employeeNew')}}">New employee</a>
                @endcan
                <a class="collapse-item" href="{{ route('employeesAll')}}">Show employees</a>
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
