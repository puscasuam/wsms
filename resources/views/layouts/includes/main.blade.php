<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.includes.head')

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

@include('layouts.includes.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        @include('layouts.includes.navbar')

        <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        @include('layouts.includes.footer')

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

@include('layouts.includes.js')

</body>

</html>
