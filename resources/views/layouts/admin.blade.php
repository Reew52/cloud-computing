@INCLUDE('admins.blocks.head')

<!-- Page Wrapper -->
<div id="wrapper">
    @INCLUDE('admins.blocks.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" CLASS="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @INCLUDE('admins.blocks.navbar')

            <!-- Begin Page Content -->
            <div CLASS="container-fluid">
                @yield('content')
            </div>

        <!-- /.container-fluid -->
        </div>
    <!-- End of Main Content -->
    @INCLUDE('admins.blocks.footer')
    </div>

<!-- End of Content Wrapper -->
</div>

<!-- End of Page Wrapper -->
@INCLUDE('admins.blocks.js')