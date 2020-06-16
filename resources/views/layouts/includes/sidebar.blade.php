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
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
{{--            <div class="sidebar-heading">--}}
{{--                Interface--}}
{{--            </div>--}}

{{--            <!-- Nav Item - Pages Collapse Menu -->--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">--}}
{{--                    <i class="fas fa-fw fa-cog"></i>--}}
{{--                    <span>Components</span>--}}
{{--                </a>--}}
{{--                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">--}}
{{--                    <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                        <h6 class="collapse-header">Custom Components:</h6>--}}
{{--                        <a class="collapse-item" href="buttons.html">Buttons</a>--}}
{{--                        <a class="collapse-item" href="cards.html">Cards</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <!-- Nav Item - Utilities Collapse Menu -->--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">--}}
{{--                    <i class="fas fa-fw fa-wrench"></i>--}}
{{--                    <span>Utilities</span>--}}
{{--                </a>--}}
{{--                <div id="collapseUticlities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">--}}
{{--                    <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                        <h6 class="collapse-header">Custom Utilities:</h6>--}}
{{--                        <a class="collapse-item" href="utilities-color.html">Colors</a>--}}
{{--                        <a class="collapse-item" href="utilities-border.html">Borders</a>--}}
{{--                        <a class="collapse-item" href="utilities-animation.html">Animations</a>--}}
{{--                        <a class="collapse-item" href="utilities-other.html">Other</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <!-- Divider -->--}}
{{--            <hr class="sidebar-divider">--}}

<!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
            <i class="fas fa-fw fa-folder"></i>
            <span>Products</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('productAdd')}}">New product</a>
                <a class="collapse-item" href="{{ route('productsAll')}}">Show products</a>
                {{--                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>--}}
                {{--                        <div class="collapse-divider"></div>--}}
                {{--                        <h6 class="collapse-header">Other Pages:</h6>--}}
                {{--                        <a class="collapse-item" href="404.html">404 Page</a>--}}
                {{--                        <a class="collapse-item" href="blank.html">Blank Page</a>--}}
            </div>
        </div>


        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePartners" aria-expanded="true" aria-controls="collapsePartners">
            <i class="fas fa-fw fa-folder"></i>
            <span>Partners</span>
        </a>
        <div id="collapsePartners" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('partnerAdd')}}">New partner</a>
                <a class="collapse-item" href="{{ route('partnersAll')}}">Show partners</a>
            </div>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true" aria-controls="collapseOrders">
            <i class="fas fa-fw fa-folder"></i>
            <span>Orders</span>
        </a>
        <div id="collapseOrders" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">New order</a>
                <a class="collapse-item" href="">Show orders</a>
            </div>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransactions" aria-expanded="true" aria-controls="collapseTransactions">
            <i class="fas fa-fw fa-folder"></i>
            <span>Transactions</span>
        </a>
        <div id="collapseTransactions" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">New transaction</a>
                <a class="collapse-item" href="">Show transactions</a>
            </div>
        </div>


        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
            <i class="fas fa-fw fa-folder"></i>
            <span>Employees</span>
        </a>
        <div id="collapseEmployee" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">New employee</a>
                <a class="collapse-item" href="">Edit employee</a>
                <a class="collapse-item" href="">Show employees</a>
            </div>
        </div>

    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
