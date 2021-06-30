<!DOCTYPE html>
<html>
<head>
   @include('includes.backend.adminheader')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="app">
<div class="wrapper">


    <!-- Navbar -->
@include('includes.backend.adminnavbartop')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('includes.backend.adminsidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @yield('content-header')
    <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
            {{--@yield('tabs-header')--}}
                @include('includes.backend.admintabsheader')
            <!-- /.row -->

                <!-- Main row -->
                <!-- Content tabellen -->
                <div class="row">
                    <div class="col-12">
                        {{--<router-view></router-view>--}}
                       @yield('content')
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('includes.backend.adminfooter')

<!-- Control Sidebar -->
@include('includes.backend.adminsidebarright')
<!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->
</div>
<script src="{{asset('js/app.js')}}"></script>
<!-- Edit Modal Script -->
@yield('edit-delete-script')
<!-- Dropzone Scripts -->
@yield('scripts')
<!-- Image Show in box Script -->
@yield('image-script')
<!-- Pie Chart Script -->
@yield('pie-script')
<!-- Ck Editor Script -->
{{--@yield('ck-editor')--}}

</body>
</html>

